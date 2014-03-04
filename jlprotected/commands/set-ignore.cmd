cd /d %~dp0
cd ../../wwwroot/jlwebroot/justlook/css

svn propset svn:ignore c_*.css .

cd ../js
svn propset svn:ignore c_*.js .

cd ../../main/css
svn propset svn:ignore c_*.css .

cd ../js
svn propset svn:ignore c_*.js .