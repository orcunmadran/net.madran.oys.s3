#!/bin/sh
#script: restart the patServer
#author: gregory patmore
#desc:	 Quick Bash Script to restart the server
#		 Run from the patServer Directory

#location of the socket server launch script
fcssd_file="./linux/fcssd"

#location of the fcssd.pid file
pid_file="./fcssd.pid"

#make sure the fcssd file is where it 
#should be and we can execute it
if [ ! -f "$fcssd_file" ] || [ ! -x "$fcssd_file" ]; then
	echo "invalid fcssd file"
	exit 1	
	
#next we'll check the pid file that holds the pid for the SCREEN process
elif [ ! -f "$pid_file" ] || [ ! -r "$pid_file" ]; then
	echo "invalid fcssd pid file"
	exit 1	
fi

#now we retreieve the old pid and hold it for checking after restarting
old_pid=`cat $pid_file`

#kill the old process
kill $old_pid
echo "old server instance killed pid: $old_pid"

echo "restarting server now..."

#run the daemon script
$fcssd_file

exit 0 #good to go



