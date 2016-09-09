<?php
/**
 * GuzzleClient.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/07 11:45
 */

namespace OrzPicker\Catcher\Clients;

use Closure;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Response;
use LogicException;
use GuzzleHttp\Psr7\Request;
use Iterator;
use GuzzleHttp\Client;
use OrzPicker\Catcher\Client as OrzPickerClient;
use OrzPicker\Catcher\Package;
use OrzPicker\Core\Application;

/**
 * Class GuzzleClient
 *
 * @package OrzPicker\Catcher\Clients
 */
class GuzzleClient implements OrzPickerClient
{
    /**
     * @var
     */
    protected $baseUri;

    /**
     * @var
     */
    protected $catcherGenerator;

    /**
     * @var
     */
    protected $success;

    /**
     * @var
     */
    protected $fail;

    /**
     * @var
     */
    protected $client;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var int
     */
    protected $concurrency = 5;

    /**
     * GuzzleClient constructor.
     *
     * @param $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    /**
     * @param $uri
     *
     * @return $this
     */
    public function setBaseUri($uri)
    {
        $this->baseUri = $uri;

        return $this;
    }

    /**
     * @param Closure $generator
     *
     * @return $this
     */
    public function setCatcherGenerator(Closure $generator)
    {
        $this->catcherGenerator = $generator;

        return $this;
    }

    /**
     * @param Closure $callback
     *
     * @return $this
     */
    public function success(Closure $callback)
    {
        $this->success = $callback;

        return $this;
    }

    /**
     * @param Closure $callback
     *
     * @return $this
     */
    public function fail(Closure $callback)
    {
        $this->fail = $callback;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getActualClient()
    {
        return $this->client;
    }

    /**
     *
     */
    public function send()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'cookies'  => true,
        ]);

        $generator = call_user_func($this->catcherGenerator, $this);

        if ($generator instanceof Iterator || is_array($generator)) {
            $iterator = $this->iteratorBuild($generator);
            $holder   = [];
            $pool     = new Pool($this->client, $iterator($holder), [
                'concurrency' => $this->concurrency,
                'fulfilled'   => function (Response $response, $index) use (&$holder) {
                    call_user_func($this->success, new Package($holder[$index], $response, $index));
                },
                'rejected'    => function (RequestException $reason, $index) {
                    call_user_func($this->fail, new Package($reason->getRequest(), $reason->getResponse(), $index));
                },
            ]);

            $pool->promise()->wait();
        }
    }

    /**
     * @param $origin
     *
     * @return Closure
     */
    protected function iteratorBuild($origin)
    {
        return function (&$holder) use ($origin) {
            $i = 0;
            foreach ($origin as $request) {
                $holder[$i] = $request;

                if (!$request instanceof Request) {
                    throw new LogicException();
                }

                yield $request;

                $i++;
            }
        };
    }

    /**
     * @param int $limit
     *
     * @return self
     */
    public function setConcurrency($limit)
    {
        $this->concurrency = $limit;

        return $this;
    }


}