//
//  ViewController.swift
//  selfieTest
//
//  Created by Zoon Dyke on 13.05.17.
//  Copyright © 2017 mumalab. All rights reserved.
//

import UIKit
import AVFoundation
import Foundation
import Alamofire

class ViewController: UIViewController{

    
    let captureSession = AVCaptureSession()
    let stillImageOutput = AVCaptureStillImageOutput()
    var previewLayer : AVCaptureVideoPreviewLayer?
    var timer = Timer()
    var currentImage = ""
    let urlString = "https://httpbin.org/post"
    
    // If we find a device we'll store it here for later use
    var captureDevice : AVCaptureDevice?
    
    @IBOutlet weak var imageView: UIImageView!
    
    @IBAction func takeFoto(_ sender: Any) {
        print("Camera button pressed")
        saveToCamera()
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        
        captureSession.sessionPreset = AVCaptureSessionPresetHigh
        
        if let devices = AVCaptureDevice.devices() as? [AVCaptureDevice] {
            // Loop through all the capture devices on this phone
            for device in devices {
                // Make sure this particular device supports video
                if (device.hasMediaType(AVMediaTypeVideo)) {
                    // Finally check the position and confirm we've got the back camera
                    if(device.position == AVCaptureDevicePosition.front) {
                        captureDevice = device
                        if captureDevice != nil {
                            print("Capture device found")
                            beginSession()
                            self.timer = Timer.scheduledTimer(timeInterval: 5.0, target: self, selector: #selector(doCapture), userInfo: nil, repeats: true)
                        }
                    }
                }
            }
        }
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    func beginSession() {
        
        do {
            try captureSession.addInput(AVCaptureDeviceInput(device: captureDevice))
            stillImageOutput.outputSettings = [AVVideoCodecKey:AVVideoCodecJPEG]
            
            if captureSession.canAddOutput(stillImageOutput) {
                captureSession.addOutput(stillImageOutput)
            }
            
        }
        catch {
            print("error: \(error.localizedDescription)")
        }
        
        guard let previewLayer = AVCaptureVideoPreviewLayer(session: captureSession) else {
            print("no preview layer")
            return
        }
        
        self.view.layer.addSublayer(previewLayer)
        previewLayer.frame = self.view.layer.frame
        captureSession.startRunning()
    }
    
    func doCapture(){
        saveToCamera()
        //print(self.currentImage)
        if(self.currentImage != ""){
            let parameters: Parameters = [
                "capturedImage": self.currentImage,
                "username" : "Kenny",
                "password" : "s3cr3t"
            ]
            
            // All three of these calls are equivalent
            Alamofire.request(self.urlString, method: .post, parameters: parameters, encoding: URLEncoding.httpBody).responseJSON { response in
                print(response.request)  // original URL request
                print(response.response) // HTTP URL response
                print(response.data)     // server data
                print(response.result)   // result of response serialization
                
                
                
                if let JSON = response.result.value {
                    print("JSON: \(JSON)")
                }
            }
            self.currentImage = ""
        }
    }
    
    func saveToCamera(){
        if let videoConnection = stillImageOutput.connection(withMediaType: AVMediaTypeVideo) {
            
            stillImageOutput.captureStillImageAsynchronously(from: videoConnection, completionHandler: { (CMSampleBuffer, Error) in
                if let imageData = AVCaptureStillImageOutput.jpegStillImageNSDataRepresentation(CMSampleBuffer) {
                    let nsData = imageData as NSData
                    //print(nsData.base64EncodedData(options: NSData.Base64EncodingOptions(rawValue: 0) ))
                    let baseEncodedData = nsData.base64EncodedString(options: NSData.Base64EncodingOptions(rawValue: 0))
                    //print(baseEncodedData)
                    self.currentImage = baseEncodedData
                }
            })
        }
    }


}

