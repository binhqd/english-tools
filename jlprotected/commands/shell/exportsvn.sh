#!/bin/bash
if test ! $1; then
    echo "Missing required arguments: repo path, rev1, rev2"
    exit 0
fi

DOMAIN='http://192.168.1.250:8080/svn/justlook/branches/jlbd_v0.1'
REPO=$3
REV1=$1
REV2=$2
out=f:/webroot/yii/demos/current-live-version/test/
#F:/webroot/yii/demos/current-live-version
for i in $(svn diff --summarize -r $REV1:$REV2 $DOMAIN$REPO | awk '{ print $2 }'); 
    do p=$(echo "$i" |sed "s|$DOMAIN$REPO||g");
    if [ ! -d $out$(dirname $p) ]; then
        mkdir -p $out$(dirname $p);
    fi
    svn export --force $i "$out$(dirname $p)/"; 
done