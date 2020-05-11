/*
PauloRASilva
https://github.com/PRASILVA5
*/

#include <WiFi.h>
#include <HTTPClient.h>
#define button 26
#define led1 33
#define led2 32

const char* ssid = "YourWifiID";
const char* password = "YourWifiPass";

//Tip: You can use Ngrok
const char* serverName = "YourServer/HeyWaiter/post_esp32.php";

//You can change de key, but remamber to change the php file to the same value
String apiKeyValue = "Hzn97bK";

void setup() {
  Serial.begin(115200);

  WiFi.begin(ssid, password);
  Serial.println("Connecting [.");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("] ");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
 
  pinMode(button, INPUT);
  pinMode(led1, OUTPUT);
  pinMode(led2, OUTPUT);
  

}

void loop() {
  //Check WiFi connection status
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    
    // Your Domain name with URL path or IP address with path
    http.begin(serverName);
    
    // Specify content-type header
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    
    String httpRequestData = "api_key=Hzn97bK&tableNumber=table 2&request=Waiter";
    String httpRequestData2 = "api_key=Hzn97bK&tableNumber=table 2&request=Payment";
    
    
    boolean btn = digitalRead(button);
    unsigned long t0 = millis();
    while (btn) {
      btn = digitalRead(button);
      if (millis() - t0 <= 1000 and !btn ) { //fast click
       
        
        t0 = millis();
        while(millis() - t0 <= 1000){
          digitalWrite(led1,HIGH);
          
          }
          digitalWrite(led1,LOW);
    
          int httpResponseCode = http.POST(httpRequestData);
       
        break;
      }
    
      if (millis() - t0 > 1000 and !btn ) {//slow click
        
        t0 = millis();
        while(millis() - t0 <= 1000){
          digitalWrite(led2,HIGH);
          
          }
          digitalWrite(led2,LOW);
       
          int httpResponseCode2 = http.POST(httpRequestData2);
        
        break;
      }
    
    }    

}

  delay(10);
}
