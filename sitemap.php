<?php
header('Content-type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php
    require_once './application/Connection.php';
?>	
<?php
	$posts   = $db->where('active', '1')->orderBy('id', 'DESC')->get(T_POST, 10);
	foreach ($posts as $key => $post) {
		echo "<url>";
		echo "<loc>".$config['site_url'].'/articles/post/'.F_URLSlug($post->title,$post->id)."</loc>";
		echo "<priority>1.00</priority>";
        echo "</url>";		 
	}	 
?>	
<?php
	$links		 = PHP_GetMedia('');
    foreach ($links as $data) {
        echo "<url>";
		echo "<loc>".$config['site_url'].'/'.$data['url']."</loc>";
		echo "<priority>1.00</priority>";
        echo "</url>";
    }
?>
	<url>
		<loc><?php echo $config['site_url']; ?>/page/dmca</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/page/contsct</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/page/privacy-policy</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/page/terms</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/home</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/lang/spanish</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/lang/english</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/lang/german</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/lang/french</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/lang/italian</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/lang/portuguese</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/lang/russian</loc>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $config['site_url']; ?>/lang/turkish</loc>
		<priority>1.00</priority>
	</url>	
	<url>
		<loc><?php echo $config['site_url']; ?>/lang/chinese</loc>
		<priority>1.00</priority>
	</url>
</urlset>