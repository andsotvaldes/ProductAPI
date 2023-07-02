<?php
namespace App\Presentation\Filters;

class ProductFilter
{
    private $filterName;

    private $pageSize;
    private $currentPage;

    /**
     * @param $filterName
     */
    public function __construct(?array $arrayRequest)
    {
        $this->filterName = $arrayRequest['name'] ?? '';
        $this->pageSize = $arrayRequest['pageSize'] ?? 20;
        $this->currentPage = $arrayRequest['currentPage'] ?? 1;
    }

    /**
     * @return mixed|string
     */
    public function getFilterName()
    {
        return $this->filterName;
    }

    /**
     * @return int|mixed
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @return int|mixed
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

}
