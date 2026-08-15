<?php

$mkd_pages = array();
$pages = get_pages(); 
foreach($pages as $page) {
	$mkd_pages[$page->ID] = $page->post_title;
}

global $optimize_mikado_IconCollections;

//Portfolio Images

$mkdPortfolioImages = new OptimizeMikadoMetaBox("portfolio-item", "Portfolio Images (multiple upload)", '', '', 'portfolio_images');
$optimize_mikado_Framework->mkdMetaBoxes->addMetaBox("portfolio_images",$mkdPortfolioImages);

	$mkd_portfolio_image_gallery = new OptimizeMikadoMultipleImages("mkd_portfolio-image-gallery","Portfolio Images","Choose your portfolio images");
	$mkdPortfolioImages->addChild("mkd_portfolio-image-gallery",$mkd_portfolio_image_gallery);

//Portfolio Images/Videos 2

$mkdPortfolioImagesVideos2 = new OptimizeMikadoMetaBox("portfolio-item", "Portfolio Images/Videos (single upload)");
$optimize_mikado_Framework->mkdMetaBoxes->addMetaBox("portfolio_images_videos2",$mkdPortfolioImagesVideos2);

	$mkd_portfolio_images_videos2 = new OptimizeMikadoImagesVideosFramework("Portfolio Images/Videos 2","ThisIsDescription");
	$mkdPortfolioImagesVideos2->addChild("mkd_portfolio_images_videos2",$mkd_portfolio_images_videos2);

//Portfolio Additional Sidebar Items

$mkdAdditionalSidebarItems = new OptimizeMikadoMetaBox("portfolio-item", "Additional Portfolio Sidebar Items");
$optimize_mikado_Framework->mkdMetaBoxes->addMetaBox("portfolio_properties",$mkdAdditionalSidebarItems);

	$mkd_portfolio_properties = new OptimizeMikadoOptionsFramework("Portfolio Properties","ThisIsDescription");
	$mkdAdditionalSidebarItems->addChild("mkd_portfolio_properties",$mkd_portfolio_properties);

