<?php

namespace App;

use Landish\Pagination\Pagination as BasePagination;

class Pagination extends BasePagination
{
    /**
     * Pagination wrapper HTML.
     *
     * @var string
     */
    protected $paginationWrapper = '<ul class="pagination">%s %s %s</ul>';

    /**
     * Available page wrapper HTML.
     *
     * @var string
     */
    protected $availablePageWrapper = '
        <li class="page-item">
            <a class="page-link" href="%s">%s</a>
        </li>';

    /**
     * Get active page wrapper HTML.
     *
     * @var string
     */
    protected $activePageWrapper = '
        <li class="page-item active"> 
            <a class="page-link" href="#">
                %s <span class="sr-only">(current)</span>
            </a>
        </li>';

    /**
     * Get disabled page wrapper HTML.
     *
     * @var string
     */
    protected $disabledPageWrapper = '
        <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>';

    /**
     * Previous button text.
     *
     * @var string
     */
    protected $previousButtonText = '&laquo;';

    /**
     * Next button text.
     *
     * @var string
     */
    protected $nextButtonText = '&raquo;';

    /**
     * "Dots" text.
     *
     * @var string
     */
    protected $dotsText = '...';
}
