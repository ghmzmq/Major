<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="row content-wrap" id="major-posts">
    <?php if ($this->have()): ?>
        <?php while($this->next()): $newFormat = majors_Plugin::getFormat();?>

        <article class="majors-post" itemscope itemtype="http://schema.org/BlogPosting" data-rippleria>
            <?php switch ($newFormat) : case 'aside':?>
                <?php if($this->fields->thumbUrl) :?>

                    <a href="<?php $this->permalink() ?>">
                        <div class="A3-image row"><img src="<?php $this->fields->thumbUrl(); ?>" class="grow" /></div>
                    </a>
                <?php endif;?>
            <?php endswitch;?>

            <h3 class="post-title" itemprop="name headline">
                <div class="title-img">
                    <img src="<?php echo 'https://secure.gravatar.com/avatar/'.md5($this->author->mail).'?s=40&r=G&d=mm'; ?>">
                </div>
                <a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->sticky(); $this->title(); ?></a>
            </h3>
            <div class="post-contents major-text" itemprop="articleBody">
                <p><?php $this->excerpt(77, '...'); ?> <span class="read-more"><a href="<?php $this->permalink() ?>">加载全文</a></span></p>
            </div>
            <footer class="row">
                <div class="response-count">
                    <span class="intro-eye"><?php majors_Plugin::theViews(); ?> view</span>
                    <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('F j, Y');?></time>
                </div>
            </footer>
        </article>

    <?php endwhile; ?>
    <?php else: ?>
        <div>没有哦!#F5F4F4</div>

        <script>
            $.Toast("抱歉!", "没有找到与关键词相符合的结果.", "error", {
                has_icon:true,
                has_close_btn:true,
                fullscreen:false,
                timeout:0,
                sticky:false,
                has_progress:true,
                rtl:false,
            });

        </script>
    <?php endif; ?>
</div>
<div class="pagination" style="display:none">
    <?php $this->pageLink('下一页','next'); ?>
</div>

<script type="text/javascript">
    function iasNew() {
        try
        {
            var iasArt = jQuery.ias({
                container:  '#major-posts',    //大容器
                item:       '.majors-post',    //循环容器
                pagination: '.pagination',    //分页容器
                next:       '.next'    //下一页的class
            });

            iasArt.extension(new IASTriggerExtension({
                text: '加载更多', //此选项为需要点击时的文字
                html: '<div class="iasBtn"><a class="btn" href="javascript:;" role="button" data-no-instant>{text}</a></div>',
                offset: 1 //load多少页后显示加载更多按钮
            }));
            iasArt.extension(new IASSpinnerExtension());    //加载时的图片
            iasArt.extension(new IASNoneLeftExtension({text: "已经没有更多了"}));    //到底后显示的文字


            iasArt.on('rendered', function(items) {
                majorsMpmansory();
                $.Toast("加载成功!", "成功加载了下一页作品.", "success", {
                    has_icon:true,
                    has_close_btn:true,
                    fullscreen:false,
                    timeout:3000,
                    sticky:false,
                    has_progress:true,
                    rtl:false
                });
                if (typeof MathJax !== 'undefined') {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                }
            });
        }
        catch(err) {}
    }
    iasNew();

</script>
