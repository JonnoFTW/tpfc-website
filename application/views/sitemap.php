<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url();?></loc> 
        <priority>1.0</priority>
    </url>
    <?php foreach($data as $url) { ?>
    <url>
        <loc><?= base_url().strtolower($url['title']); ?></loc>
        <priority><?= ($url['permanent']?'1.0':'0.5') ?></priority>
        <changefreq>monthly</changefreq>
        <lastmod><? echo $url['updated'] ?></lastmod>
    </url>
    <?php } ?>
    
    <?php foreach(array('gallery','resources','contact') as $v) { ?>
    <url>
        <loc><?= base_url().$v ?></loc>
        <priority>0.75</priority>
    </url>
    <?php } ?>
    
</urlset>