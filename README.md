# Smart-Car-Wash-System

Smart Car Wash System is an automated car washing solution that combines a web booking platform with embedded hardware control.
The system allows customers to book online, receive a QR code, and complete the washing process automatically using sensors and a Raspberry Pi controller.

## Overview

This project was developed to reduce manual work, minimize waiting time, and improve service efficiency in car wash stations.  
It connects a website with real-time hardware components to create a complete automated workflow.

## Main Features

- Online reservation system
- Unique QR code generation for each booking
- QR code verification using Raspberry Pi camera
- Ultrasonic sensors for vehicle detection
- Automated conveyor belt system
- Automatic control of soap and water pumps
- Admin dashboard to manage reservations and users
- Booking conflict prevention (time gap control)

## Technologies Used

- Raspberry Pi 4B
- Python
- PHP
- MySQL
- XAMPP
- Ultrasonic Sensors
- Relay Modules
- DC Motors & Pumps

## How It Works

1. The customer books an appointment through the website.
2. The system generates a unique QR code.
3. At arrival, the QR code is scanned by the camera.
4. If valid, the gate opens.
5. Sensors detect the vehicle.
6. Conveyor belt and pumps operate automatically.
7. The washing process completes without manual intervention.

## Project Structure

The project includes:

- Web application (booking & admin panel)
- Embedded control system (Raspberry Pi + sensors)
- Mechanical conveyor prototype
- Database design
- Testing and validation

## Full Documentation

For detailed demo, documentation, diagrams, implementation steps, testing results, and full project report, visit:

https://drive.google.com/drive/folders/12J21kd0u9eMx1eOyaeYy4KPTYTqx-4uy

## Installation & Usage

Clone the repository:

```bash
git clone https://github.com/husam1salameh/Smart-Car-Wash-System.git
