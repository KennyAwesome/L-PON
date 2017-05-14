//
//  Products.swift
//  L-PON-Client
//
//  Created by Zoon Dyke on 14.05.17.
//  Copyright © 2017 mumalab. All rights reserved.
//

import Foundation
import Alamofire

final class Products{
    let requestUrl = "http://10.100.126.150/api/products?shop=sl&sl_gender=men&sl_max_price=100"
    static let sharedInstance: Singleton = {
        let instance = Singleton()
        
        let headers: HTTPHeaders = [
            "Authorization": "Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==",
            "Accept": "application/json"
        ]
        
        
        // All three of these calls are equivalent
        
        Alamofire.request(self.urlString, method: .post, encoding: URLEncoding.httpBody).responseJSON { response in
            print(response.request)  // original URL request
            print(response.response) // HTTP URL response
            print(response.data)     // server data
            print(response.result)   // result of response serialization
            
            
            
            if let JSON = response.result.value{
                print(JSON)
            }
        }
        return instance
    }
    
    
    }
