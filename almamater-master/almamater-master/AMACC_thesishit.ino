#include <NewPing.h>
#include <Servo.h>
#include <SoftwareSerial.h>
Servo myservo;
SoftwareSerial mySerial(51, 50);
int pos = 0;
boolean goesForward = false;  // goesForward
boolean fire = false;
const int LeftMotorForward = 9;     // LM forward
const int LeftMotorBackward = 27;   // LM backward
const int RightMotorForward = 26;   // RM forward
const int RightMotorBackward = 10;  // RM backward
const int ena = 5;
const int enb = 13;
#define Left_S 6               // left sensor
#define Forward_S 22           // middle sensor
#define Right_S 28              // right sensor
#define buzzer 23              // buzzer
#define frontecho 8                 // echo pin
#define fronttrig 7                 // trig pin
#define leftecho 12
#define lefttrig 11
#define rightecho 3
#define righttrig 2
#define servoM 4               // Servo motor pin
#define PWM 128
#define DIST 20
#define LASTDIST 15
void updateSerial() {
    delay(500);
    while (Serial.available()) {
        mySerial.write(
        Serial.read());  // Forward what Serial received to Software Serial Port
    }
    while (mySerial.available()) {
        Serial.write(
        mySerial.read());  // Forward what Software Serial received to Serial Port
    }
}
void forward()
{
    digitalWrite(LeftMotorForward, HIGH);
    digitalWrite(LeftMotorBackward, LOW);
    digitalWrite(RightMotorForward, HIGH);
    digitalWrite(RightMotorBackward, LOW);
    analogWrite(ena, PWM);
    analogWrite(enb, PWM);
    //delay(500);
}
void reverse()
{
    digitalWrite(LeftMotorForward, LOW);
    digitalWrite(LeftMotorBackward, HIGH);
    digitalWrite(RightMotorForward, LOW);
    digitalWrite(RightMotorBackward, HIGH);
    analogWrite(ena, PWM);
    analogWrite(enb, PWM);
    //delay(500);
}
void motorstop()
{
    digitalWrite(LeftMotorForward, LOW);
    digitalWrite(LeftMotorBackward, LOW);
    digitalWrite(RightMotorForward, LOW);
    digitalWrite(RightMotorBackward, LOW);
    analogWrite(ena, LOW);
    analogWrite(enb, LOW);
    
}
void turn_left ()
{
    digitalWrite(LeftMotorForward, HIGH);
    digitalWrite(LeftMotorBackward, LOW);
    digitalWrite(RightMotorForward, LOW);
    digitalWrite(RightMotorBackward, HIGH);
    analogWrite(ena, PWM);
    analogWrite(enb, PWM);
    //delay(500);
}
void turn_right ()
{
    digitalWrite(LeftMotorForward, LOW);
    digitalWrite(LeftMotorBackward, LOW);
    digitalWrite(RightMotorForward, LOW);
    digitalWrite(RightMotorBackward, HIGH);
    analogWrite(ena, PWM);
    analogWrite(enb, PWM);
    //delay(500);
}
#define MAX_DISTANCE 200 
NewPing sonar(fronttrig, frontecho, MAX_DISTANCE); 
NewPing sonar_right(righttrig, rightecho, MAX_DISTANCE); 
NewPing sonar_left(lefttrig, leftecho, MAX_DISTANCE); 
unsigned int frontsensor_value = 0;
unsigned int rightsensor_value = 0;
unsigned int leftsensor_value  = 0;
/*---END OF DECLARATIONS---*/

void operate(){
  moving();
  }
void moving(){
  unsigned int ultrasonic = sonar.ping();
  frontsensor_value = ultrasonic / US_ROUNDTRIP_CM;
  Serial.println("\nFRONT: ");
      Serial.print(frontsensor_value);
      Serial.print(" cm\n");
      if (frontsensor_value < 50 && frontsensor_value > 0) {
          reverse();
          delay(100);
          avoid();
      }
      else if(frontsensor_value <= 0){
        forward();
        }
      Serial.println("\nForward\n");
      forward();
      delay(50);
  }
  void avoid(){
       int loopback;
       unsigned int uleft = sonar_left.ping();
       unsigned int uright = sonar_right.ping();
       leftsensor_value = uleft / US_ROUNDTRIP_CM;
       rightsensor_value = uright / US_ROUNDTRIP_CM;
       Serial.println("\nLEFT: ");
       Serial.print(leftsensor_value);
       Serial.print(" cm\n");
       Serial.println("\nRIGHT: ");
       Serial.print(rightsensor_value);
       Serial.print(" cm\n");
       if (leftsensor_value > 60) {
           Serial.println("GOING LEFT"); 
           motorstop();
           delay(200);
           turn_left(); 
           delay(200);
      } 
      else if (rightsensor_value > 60){
           Serial.println("GOING RIGHT"); 
           motorstop();
           delay(200);
           turn_right(); 
           delay(200);
      } 
   
       else {
           for (loopback = 0; loopback < 2; loopback++) {
               reverse(); 
           }
      }
    }
void setup() {
    //put your setup code here, to run once:
    Serial.begin(9600);
    mySerial.begin(9600);
    pinMode(RightMotorForward, OUTPUT);
    pinMode(LeftMotorForward, OUTPUT);
    pinMode(LeftMotorBackward, OUTPUT);
    pinMode(RightMotorBackward, OUTPUT);
    pinMode(ena, OUTPUT);
    pinMode(enb, OUTPUT);
    pinMode(Left_S, INPUT);
    pinMode(Forward_S, INPUT);
    pinMode(Right_S, INPUT);
    pinMode(fronttrig, OUTPUT);
    pinMode(frontecho, INPUT);
    pinMode(lefttrig, OUTPUT);
    pinMode(leftecho, INPUT);
    pinMode(righttrig, OUTPUT);
    pinMode(rightecho, INPUT);
    pinMode(buzzer, OUTPUT);
  
}
void loop() {
  operate();
  
    if (digitalRead(Left_S) == 1 && digitalRead(Right_S) == 1 && digitalRead(Forward_S) == 1) {
        fire = false;
        } else if (digitalRead(Left_S) == 0) {
        fire = true;
        Serial.println("Fire Detected at Pin 6");
        } else if (digitalRead(Right_S) == 0) {
        fire = true;
        Serial.println("Fire Detected at Pin 5");
        } else if (digitalRead(Forward_S) == 0) {
        fire = true;
        Serial.println("Fire Detected at Pin 22");
    }
    if (fire == true) {
        //motorstop();
        Serial.println("Fire");
        digitalWrite(buzzer,HIGH);
        delay(500);
        digitalWrite(buzzer,LOW);
    }
}
