#!/bin/bash
DOMAIN='http://192.168.1.250:8080/svn/justlook'
REPO=/branches/jlbd_v0.1
REV=$1
out=f:/webroot/yii/demos/current-live-version/test
#F:/webroot/yii/demos/current-live-version
for i in $(svn log $DOMAIN$REPO -qv -r$REV | awk '/\//{print $2}'); 
    do p=$(echo "$i" |sed "s|$REPO||g");

    if [ ! -d $out$(dirname $p) ]; then
        mkdir -p $out$(dirname $p);
    fi
    svn export --force -r$REV $DOMAIN$i "$out$(dirname $p)/"; 
done