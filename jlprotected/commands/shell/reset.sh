#!/bin/sh
JLROOT="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && cd ".." && cd ".." && cd ".." && pwd)";
wwwrootAsset="${JLROOT}/wwwroot/jlwebroot/assets";
wwwrootJustlook="${JLROOT}/wwwroot/jlwebroot/justlook";
wwwrootUpload="${JLROOT}/wwwroot/jlwebroot/upload";
runtimeDir="${JLROOT}/jlruntime";
feedbackDataDir="${JLROOT}/jlprotected/modules/feedback/data";

#chmod 0755 -R $wwwrootAsset;
chown "www-data" -R $wwwrootAsset;
#chmod 0755 -R $wwwrootJustlook;
chown "www-data" -R $wwwrootJustlook;
#chmod 0755 -R $wwwrootUpload;
chown "www-data" -R $wwwrootUpload;
#chmod 0755 -R $runtimeDir;
chown "www-data" -R $runtimeDir;
#chmod 0755 "${runtimeDir}/published.txt"
chown "www-data" -R "${runtimeDir}/published.txt";
#chmod 0755 -R $feedbackDataDir;
chown "www-data" -R $feedbackDataDir;