using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Text;
using System.Threading.Tasks;

namespace Lpon.Console.WebLogic
{
    public class AzureManager
    {
        static public async Task<JObject> MakeRequest(byte[] byteData)
        {
            var client = new HttpClient();

            // Request headers
            client.DefaultRequestHeaders.Add("Ocp-Apim-Subscription-Key", "6f1b3228984c4fc59365f97893cb0610");

            string uri = "https://westus.api.cognitive.microsoft.com/emotion/v1.0/recognize?";
            HttpResponseMessage response;
            //string responseContent;
            

            using (var content = new ByteArrayContent(byteData))
            {
                // This example uses content type "application/octet-stream".
                // The other content types you can use are "application/json" and "multipart/form-data".
                content.Headers.ContentType = new MediaTypeHeaderValue("application/octet-stream");
                response = await client.PostAsync(uri, content);
                string responseString = await response.Content.ReadAsStringAsync();
                return JObject.Parse(responseString);
            }

            //A peak at the JSON response.
        }

        static async void MakeRequest(string imageFilePath)
        {
            // Request body. Try this sample with a locally stored JPEG image. 
            byte[] byteData = GetImageAsByteArray(imageFilePath);
            await MakeRequest(byteData);
        }

        static byte[] GetImageAsByteArray(string imageFilePath)
        {
            FileStream fileStream = new FileStream(imageFilePath, FileMode.Open, FileAccess.Read);
            BinaryReader binaryReader = new BinaryReader(fileStream);
            return binaryReader.ReadBytes((int)fileStream.Length);
        }

    }
}
