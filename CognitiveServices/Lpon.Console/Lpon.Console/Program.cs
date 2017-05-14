using Microsoft.Owin.Hosting;
using System;
using System.Net.Http;
using System.IO;
using System.Linq;
using System.Text;
using System.Net.Http.Headers;
using static System.Console;
using Lpon.Console.WebLogic;
using System.Net;
using Newtonsoft.Json.Linq;

namespace Lpon.Console
{
    class Program
    {
        static void Main()
        {
            string baseAddress = "http://10.100.126.96:9123/";

            // Start OWIN host 
            using (WebApp.Start<Startup>(url: baseAddress))
            {
                ReadLine();
            }

            Write("Enter the path to a JPEG image file:");
            string imageFilePath = ReadLine();

            MakeRequest(imageFilePath);

            WriteLine("\n\n\nWait for the result below, then hit ENTER to exit...\n\n\n");
            ReadLine();
        }

        static byte[] GetImageAsByteArray(string imageFilePath)
        {
            FileStream fileStream = new FileStream(imageFilePath, FileMode.Open, FileAccess.Read);
            BinaryReader binaryReader = new BinaryReader(fileStream);
            return binaryReader.ReadBytes((int)fileStream.Length);
        }

        static async void MakeRequest(string imageFilePath)
        {
            var client = new HttpClient();

            // Request headers
            client.DefaultRequestHeaders.Add("Ocp-Apim-Subscription-Key", "6f1b3228984c4fc59365f97893cb0610");

            string uri = "https://westus.api.cognitive.microsoft.com/emotion/v1.0/recognize?";
            HttpResponseMessage response;
            string responseContent;

            // Request body. Try this sample with a locally stored JPEG image. 
            byte[] byteData = GetImageAsByteArray(imageFilePath);

            using (var content = new ByteArrayContent(byteData))
            {
                // This example uses content type "application/octet-stream".
                // The other content types you can use are "application/json" and "multipart/form-data".
                content.Headers.ContentType = new MediaTypeHeaderValue("application/octet-stream");
                response = await client.PostAsync(uri, content);
                responseContent = response.Content.ReadAsStringAsync().Result;
            }

            //A peak at the JSON response.
            WriteLine(responseContent);
        }

    }
}
