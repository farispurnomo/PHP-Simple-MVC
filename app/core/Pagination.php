<?php

class Pagination
{
    public static function render($total_pages, $current_page = 1)
    {
        $limit = 2; // limit kanan kiri item aktif ex: 1 2 [3] 4 5

        $links = "";
        if ($total_pages >= 1 && $current_page <= $total_pages) {
            $links .= '<li class="page-item">
                         <span class="page-link">&laquo;</span>
                     </li>';
            $i = max(1, $current_page - $limit);
            if ($i > 2)
                $links .= '<li class="page-item disabled">
                            <a class="page-link" href="#">....</a>
                        </li>';

            for (; $i <= min($current_page + $limit, $total_pages); $i++) {
                if ($i == $current_page) {
                    $links .= '<li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">' . $i . '</a>
                            </li>';
                } else {
                    $links .= '<li class="page-item">
                                <a class="page-link" href="javascript:void(0)" onclick="renderTable(' . $i . ')">' . $i . '</a>
                            </li>';
                }
            }

            if ($i < $total_pages + 1)
                $links .= '<li class="page-item disabled">
                                <a class="page-link" href="#">....</a>
                            </li>';

            $links .= '<li class="page-item">
                            <a class="page-link" href="#">&raquo;</a>
                        </li>';
        }
        return ' 
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                ' . $links . '
            </ul>
        </nav>';
    }
}
