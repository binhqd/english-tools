cd /d %~dp0
set CURDIR=%CD%
putty -ssh look.vn -l tcx -pw tcx123tcx -m %CURDIR%\shell\cleanAsset.sh"