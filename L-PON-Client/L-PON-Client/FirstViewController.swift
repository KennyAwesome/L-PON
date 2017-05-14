//
//  FirstViewController.swift
//  L-PON-Client
//
//  Created by Zoon Dyke on 13.05.17.
//  Copyright © 2017 mumalab. All rights reserved.
//

import UIKit
import AVFoundation
import Foundation
import Alamofire



class FirstViewController: UIViewController {
    
    let captureSession = AVCaptureSession()
    let stillImageOutput = AVCaptureStillImageOutput()
    var previewLayer : AVCaptureVideoPreviewLayer?
    var timer = Timer()
    var currentImage = ""
    var progressCounter = 0
    let urlString = "http://10.100.126.96:9123/api/lpon/SendImage"
    
    let lorem = "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod" // 78 char
    
    let destinationUrls = [
        "http://i.giatamedia.com/s.php?uid=606&source=xmlpool2&size=800&cid=17121&iid=7146475",
        ""
    ]
    
    let fashionUrls = [
        "https://res.cloudinary.com/stylight/image/upload/t_p_res878sq/product-people-tree-vanessa-jersey-skirt-pale-blue-100-baumwolle-108264458",
        ""
    ]
    // If we find a device we'll store it here for later use
    var captureDevice : AVCaptureDevice?
    
    //--------------------

    @IBOutlet weak var facePreview: UIImageView!
    
    @IBOutlet weak var progressBar: UIProgressView!
    
    @IBOutlet weak var tagCloud: UILabel!
    
    @IBOutlet weak var productType: UISegmentedControl!
    
    @IBOutlet weak var productImage: UIImageView!
    //--------------------
    var onStartup = true
    //let overlay = LoadingOverlay.shared
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        //if(self.onStartup){
        //    overlay.showOverlay(view: <#T##UIView!#>)
        //}
        self.startTimer()
        //self.stopTimer()
        self.tagCloud.text = lorem
        self.productImage.imageFromServerURL(urlString: self.destinationUrls.first!)
    }
    
    func startTimer(){
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
                            self.timer = Timer.scheduledTimer(timeInterval: 1.0, target: self, selector: #selector(doCapture), userInfo: nil, repeats: true)
                            
                            //self.timer = Timer.scheduledTimer(timeInterval: 5.0, target: self, selector: #selector(nativeCall), userInfo: nil, repeats: true)
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
    
    
    //---------------------------
    func showNewProduct(){
    //---------------------------
        
        
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
        

            
            //= CGAffineTransformIdentity.scaledBy(x: 2, y: 2)
        self.facePreview.layer.addSublayer(previewLayer ) // IMPORTANT
        previewLayer.frame = self.view.layer.frame
            //.size.applying(.scaledBy( x: 0.5, y : 0.5 ) )

        captureSession.startRunning()
        //self.facePreview.transform.scaledBy(x: 0.01, y: 0.01)
    }
    
    func doCapture(){
        
        let max : Float = 2.0
        progressCounter += 1
        
        if(progressCounter > lroundf(max)){
            progressCounter = 0
            // get product image here
            if(self.productType.selectedSegmentIndex == 0){
                self.productImage.imageFromServerURL(urlString: self.destinationUrls.first!)
            }else{
                self.productImage.imageFromServerURL(urlString: self.fashionUrls.first!)
            }
            // ASYNC Image
            
            sleep(1) // -> latency for image
            saveToCamera()
            //print(self.currentImage)
            if(self.currentImage != ""){
                let headers: HTTPHeaders = [
                    "Authorization": "Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==",
                    "Accept": "application/json"
                ]
                
                let parameters: Parameters = [
                    "capturedImage": self.currentImage,
                    "username" : "Kenny",
                    "password" : "s3cr3t",
                    "email" : "testing@avatify.com"
                ]
                
                // All three of these calls are equivalent
                
                Alamofire.request(self.urlString, method: .post, parameters: parameters, encoding: URLEncoding.httpBody).responseJSON { response in
                    print(response.request)  // original URL request
                    print(response.response) // HTTP URL response
                    print(response.data)     // server data
                    print(response.result)   // result of response serialization
                    
                    
                    
                    if let happiness = response.result.value{
                            if(happiness as! Float > 0.8){
                                print("Match")
                                self.alertForMatch()
                                self.stopTimer()
                            }
                        
                    }
                }
                self.currentImage = ""
            }
        }
        progressBar.progress = Float(progressCounter)/max
        print(Float(progressCounter)/max)
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
    
    func stopTimer(){
        self.timer.invalidate()
        self.captureSession.stopRunning()
        self.view.layer.removeFromSuperlayer()
        //self.view.shouldUpdateFocus(in: self.view.clearsContextBeforeDrawing )
    }

    @IBAction func changeProductType(_ sender: Any) {
        if(self.productType.selectedSegmentIndex == 0){
            self.productImage.imageFromServerURL(urlString: self.destinationUrls.first!)
        }else{
            self.productImage.imageFromServerURL(urlString: self.fashionUrls.first!)
        }
    }
    
    // -----------------------------------------------------------------------------
    func alertForMatch(){
    // -----------------------------------------------------------------------------
        let alertController = UIAlertController(title: "MATCH!", message:
            "Congratulations, you found your dream product!", preferredStyle: UIAlertControllerStyle.alert)
        alertController.addAction(UIAlertAction(title: "Continue Matching", style: UIAlertActionStyle.default,handler: {(alert: UIAlertAction!) in self.startTimer()})) // does actually nothing
        alertController.addAction(UIAlertAction(title: "See my Wishlist", style: UIAlertActionStyle.default,handler:  {(alert: UIAlertAction!) in self.gotoWishlist()}))
        
        self.present(alertController, animated: true, completion: nil)
        
    }
    
    func gotoWishlist(){
        //self.tabBarController?.
        //selectedIndex = 1
    }
    
    func getProducts(){
        
    }

}
//---- end of class
extension UIImageView {
    public func imageFromServerURL(urlString: String) {
        
        URLSession.shared.dataTask(with: NSURL(string: urlString)! as URL, completionHandler: { (data, response, error) -> Void in
            
            if error != nil {
                print(error)
                return
            }
            DispatchQueue.main.async(execute: { () -> Void in
                let image = UIImage(data: data!)
                self.image = image
            })
            
        }).resume()
}}

