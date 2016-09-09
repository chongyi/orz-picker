<?php
/**
 * Package.php
 *
 * Creator:    chongyi
 * Created at: 2016/09/08 16:18
 */

namespace OrzPicker\Catcher;


use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Package
{
    /**
     * @var Response
     */
    public $response;

    /**
     * @var Request
     */
    public $request;

    /**
     * @var int
     */
    public $index;

    /**
     * Package constructor.
     *
     * @param Request  $request
     * @param Response $response
     * @param int      $index
     */
    public function __construct(Request $request, Response $response, $index)
    {
        $this->response = $response;
        $this->request  = $request;
        $this->index    = $index;
    }


}