<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.jonathandavidharris.co.uk
 * @since      1.0.0
 *
 * @package    Simple_Google_News_Sitemap
 * @subpackage Simple_Google_News_Sitemap/public/partials
 */

header('Content-Type: ' . feed_content_type($this->plugin_name) . '; charset=' . get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';

?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
<?php

		while( have_posts()) : the_post();
			?>
			<url>
				<loc><?php the_permalink();?></loc>
				<news:news>
					<news:publication>
						<news:name><?php bloginfo('name');?></news:name>
						<news:language><?php bloginfo('language');?></news:language>
					</news:publication>
					<news:publication_date><?php the_date('Y-m-d'); ?></news:publication_date>
					<news:title><?php the_title();?></news:title>
					<?php if($tags = get_the_tag_list('',', ')):?>
						<news:keywords><?php echo wp_strip_all_tags($tags); ?></news:keywords>
					<?php endif;?>
				</news:news>
			</url>
		<?php endwhile; ?>
</urlset>