<?php

require_once __DIR__ . '/inicio-html.php';
/** @var $videoList*/

?>
<ul class="videos__container" alt="videos alura">
    <?php foreach ($videoList as $video) { ?>
        <?php if (str_starts_with($video->url, 'http')) { ?>
            <li class="videos__item">
                <iframe width="100%" height="72%" src="<?php echo $video->url; ?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                <div class="descricao-video">
                    <img src="img/logo.png" alt="logo canal alura">
                    <h3><?php echo $video->title; ?></h3>
                    <div class="acoes-video">
                        <a href="/editar-video?id=<?php echo $video->id; ?>">Editar</a>
                        <a href="/remover-video?id=<?php echo $video->id; ?>">Excluir</a>
                    </div>
                </div>
            </li>
        <?php } ?>
    <?php } ?>
</ul>

<?php require_once __DIR__ . '/fim-html.php';