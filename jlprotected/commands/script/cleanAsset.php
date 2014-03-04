<?php
$jlprotected = realpath(dirname(__FILE__) . "/../../");
$jlwebroot = realpath(dirname(__FILE__) . "/../../../wwwroot/jlwebroot");
$runtime = realpath(dirname(__FILE__) . "/../../../jlruntime");

// clean /published.txt
@unlink($runtime . "/published.txt");

// clean compiled css files

function cleanPath($path) {
	if (!is_dir($path)) return;
	$handle = opendir($path);
	while ($file = readdir($handle)) {
		$pattern = "/^c_[0-9a-fA-F]+\.(css|js)$/";
		if (preg_match($pattern, $file)) {
			unlink ($path . "/{$file}");
		}
	}
}

echo "Cleaning /justlook/css\n";
cleanPath($jlwebroot . "/justlook/css");
echo "Cleaning /justlook/js\n";
cleanPath($jlwebroot . "/justlook/js");
echo "Cleaning /main/css\n";
cleanPath($jlwebroot . "/main/css");
echo "Cleaning /main/js\n";
cleanPath($jlwebroot . "/main/js");
echo "Cleaning /assets/default/css\n";
cleanPath($jlwebroot . "/assets/default/css");
echo "Cleaning /assets/default/js\n";
cleanPath($jlwebroot . "/assets/default/js");
echo "Cleaning /assets/layout-dashboard/css\n";
cleanPath($jlwebroot . "/assets/layout-dashboard/css");
echo "Cleaning /assets/layout-dashboard/js\n";
cleanPath($jlwebroot . "/assets/layout-dashboard/js");
echo "Cleaning /assets/messages/css\n";
cleanPath($jlwebroot . "/assets/messages/css");
echo "Cleaning /assets/messages/js\n";
cleanPath($jlwebroot . "/assets/messages/js");
echo "Cleaning /assets/saved_search/css\n";
cleanPath($jlwebroot . "/assets/saved_search/css");
echo "Cleaning /assets/saved_search/js\n";
cleanPath($jlwebroot . "/assets/saved_search/js");
echo "Cleaning /assets/search-sidebar/css\n";
cleanPath($jlwebroot . "/assets/search-sidebar/css");
echo "Cleaning /assets/search-sidebar/js\n";
cleanPath($jlwebroot . "/assets/search-sidebar/js");
echo "Cleaning /assets/user/css\n";
cleanPath($jlwebroot . "/assets/user/css");
echo "Cleaning /assets/user/js\n";
cleanPath($jlwebroot . "/assets/user/js");
echo "Cleaning /assets/lists/css\n";
cleanPath($jlwebroot . "/assets/lists/css");
echo "Cleaning /assets/lists/js\n";
cleanPath($jlwebroot . "/assets/lists/js");
// following
echo "Cleaning /assets/followings/css\n";
cleanPath($jlwebroot . "/assets/followings/css");
echo "Cleaning /assets/followings/js\n";
cleanPath($jlwebroot . "/assets/followings/js");
// bootstrap
// following
echo "Cleaning /assets/bootstrap/css\n";
cleanPath($jlwebroot . "/assets/bootstrap/css");
echo "Cleaning /assets/bootstrap/js\n";
cleanPath($jlwebroot . "/assets/bootstrap/js");
echo "Cleaning /assets/bootstrap/img\n";
cleanPath($jlwebroot . "/assets/bootstrap/img");
echo "Cleaning /assets/bootstrap/less\n";
cleanPath($jlwebroot . "/assets/bootstrap/less");