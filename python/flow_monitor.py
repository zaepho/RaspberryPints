#!/usr/bin/python
import serial
import syslog
import time
import subprocess
import requests

#The following line is for serial over GPIO
port = '/dev/ttyS0'
#The following line is for serial over USB
#port = '/dev/ttyACM0'

arduino = serial.Serial(port,9600,timeout=2)

# Edit this line to point to where your rpints install is
RPints_API = 'http://localhost/includes/pours.php'
# Future Use
API_KEY = 'INSERT_API_KEY_HERE'
running = True

try:
	while running:	
		msg = arduino.readline()
		if not msg:
			continue
		reading = msg.split(";")
		if ( len(reading) < 2 ):
			print "Unknown message: "+msg
			continue
		if ( reading[0] == "P" ):
			MCP_ADDR = int(reading[1])
			MCP_PIN = str(reading[2])
			POUR_COUNT = str(reading[3])
			PULSES_PERL = 5600
			
			#MLITERS = (POUR_COUNT/5.600)/1000			
			
			#Uncomment next for lines for debugging
			#print "Pour:"
			#print "  - Addr : "+hex(MCP_ADDR)
			#print "  - Pin  : "+str(MCP_PIN)
			#print "  - Count: "+str(POUR_COUNT)
			#print "  - Ounces: "+str(POUR_COUNT / 165)
			#print "  - Mliters: "+str(MLITERS)
						
			#The following passes the PIN and PULSE COUNT to the RPints API		
			data = {'API_KEY':API_KEY,
				'API_ACTION':'pour',
				'pin':MCP_PIN,
				'amount':POUR_COUNT
			}
			r = requests.post(url = RPints_API, data = data)
		elif ( reading[0] == "K" ):
			MCP_ADDR = int(reading[1])
			MCP_PIN = int(reading[2])
			#print "Keg Kicked:"
			#print "  - Addr : "+hex(MCP_ADDR)
			#print "  - Pin  : "+str(MCP_PIN)
		else:
			print "Unknown message: "+msg
finally:
        print "Exiting"
