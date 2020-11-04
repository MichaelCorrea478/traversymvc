index page!
<h1><?php echo $data['title']; ?></h1>

<ul>

    <?php foreach($data['posts'] as $post) {
        echo '<li>' . $post->title . '</li>';
    } ?>

</ul>