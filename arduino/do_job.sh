#!/bin/bash
# --verify = compila
# --upload = trasferisce
# --port port_name
# -v verbose

PATH=$PATH:~/programmi/arduino-1.8.13

if [[ $# -lt 1 ]] 
then
	echo "Manca un argomento build/send"
	exit 1
fi

if [[ $1 == "build" ]] 
then
	arduino -v --verify ./main.ino
fi

if [[ $1 == "send" ]] 
then
	arduino -v --upload --port /dev/ttyUSB0 ./main.ino
fi
#arduino --verify ./main.ino
#arduino --upload --port /dev/ttyUSB0 ./main.ino


