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
        static public async Task<JToken> MakeRequest(byte[] byteData)
        {
            var client = new HttpClient();

            client.DefaultRequestHeaders.Add("Ocp-Apim-Subscription-Key", "6f1b3228984c4fc59365f97893cb0610");

            string uri = "https://westus.api.cognitive.microsoft.com/emotion/v1.0/recognize?";
            HttpResponseMessage response;
            

            using (var content = new ByteArrayContent(byteData))
            {
                content.Headers.ContentType = new MediaTypeHeaderValue("application/octet-stream");
                response = await client.PostAsync(uri, content);
                string responseString = await response.Content.ReadAsStringAsync();
                responseString = responseString.Substring(1, responseString.Length - 2);
                if (responseString.Length < 3)
                {
                    return JToken.FromObject("0.0");
                }
                JObject emotionScore = JObject.Parse(responseString);
                JToken happiness = emotionScore["scores"]["happiness"];
                return happiness;
            }
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
