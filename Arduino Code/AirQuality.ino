#include <Wire.h>
#include <WiFi.h>
#include "SparkFunBME280.h"
#include "SparkFunCCS811.h" //Click here to get the library: http://librarymanager/All#SparkFun_CCS811
#include <HTTPClient.h>
#define CCS811_ADDR 0x5B //Default I2C Address
// Variable Declaration
int del = 60000;
double humidity;
double pressure;
double altitude;
int co2;
double temp;
int node_id = 1;
//String host = "https://w3stu.cs.jmu.edu/morri6jc/";
CCS811 mySensor(CCS811_ADDR);
BME280 mySensorTwo;
HTTPClient http;
void setup()
{
  Serial.begin(115200);
  Serial.println("CCS811 Basic Example");
  Wire.begin(); //Inialize I2C Hardware
if (mySensorTwo.beginI2C() == false) //Begin communication over I2C
  {
    Serial.println("The sensor did not respond. Please check wiring.");
    while(1); //Freeze
  }
  if (mySensor.begin() == false)
  {
    Serial.print("CCS811 error. Please check wiring. Freezing...");
    while (1)
      ;
  }
  WiFi.begin("Verizon-791L-A5DC", "349d7197");
  while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.print(".");
    }
    Serial.println("");
    Serial.println("WiFi connected");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());
  //   bool http_begin = http.begin("https://iotserver.website/airquality.php");
       bool http_begin = http.begin("http://18.212.77.17/api/add_air_quality_record.php");
              
       }
void loop()
{
  
  delay(1000);
  
    Serial.print("Humidity: ");
    humidity = mySensorTwo.readFloatHumidity();
      
      Serial.print(humidity, 0);
      Serial.print(" Pressure: ");
      pressure = mySensorTwo.readFloatPressure();
      Serial.print(pressure, 0);
  Serial.print(" Alt: ");
  altitude = mySensorTwo.readFloatAltitudeFeet();
  Serial.print(altitude, 1);
  Serial.print(" Temp: ");
  //Serial.print(mySensor.readTempC(), 2);
  temp = mySensorTwo.readTempF();
  Serial.print(temp, 2);
  Serial.println();
  delay(60000);
    
      //time = micros();
      if (mySensor.dataAvailable()) {
        mySensor.readAlgorithmResults();
      co2 = mySensor.getCO2();
      Serial.print(co2);
      Serial.print(" ");
      }
        
// Set up POST Request
String payload_request = "node_id="+String(node_id)+"&co2="+String(co2)+"&temp=" + String(temp)+"&humidity=" + String(humidity)+"&pressure=" + String(pressure)+"&api_key=abc123";          
Serial.println(payload_request);
http.addHeader("Content-Type", "application/x-www-form-urlencoded");
int httpResponseCode = http.sendRequest("POST", payload_request);
Serial.println(httpResponseCode);
String payload_response = http.getString();
Serial.println(payload_response);
}
