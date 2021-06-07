<?php


function inject_sidebar($lastest = [])
{

    $html =  '<div class="col-lg-4">
        <div class="blog_right_sidebar">
            <aside class="single_sidebar_widget search_widget">
                <form action="' . base_url("berita") . '" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="s" placeholder="Cari Berita..">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="lnr lnr-magnifier"></i></button>
                        </span>
                    </div><!-- /input-group -->
                </form>
                <div class="br"></div>
            </aside>
            <aside class="single_sidebar_widget popular_post_widget">
                <h3 class="widget_title">Berita Terbaru</h3>';

    if (!empty($lastest)) {
        foreach ($lastest as $k => $v) :
            $html .= '<div class="media post_item">
                            <img src="' . base_url('uploads/img/' . $v['gambar']) . '" style="width: 75px;" alt="' . $v['judul'] . '">
                            <div class="media-body">
                                <a href="' . base_url('berita/' . $v['slug']) . '">
                                    <h3>' . $v['judul'] . '</h3>
                                </a>
                            </div>
                        </div>';
        endforeach;
    }

    $html .= '<div class="br"></div>
            </aside>
        </div>
    </div>';

    return $html;
}
