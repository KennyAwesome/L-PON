using Lpon.Console.Model;
using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.IO;
using System.Threading.Tasks;
using System.Web.Http;

namespace Lpon.Console.WebLogic
{
    public class LponController : ApiController
    {
        public LponController()
            : base()
        {
            var hans = this.Request;
        }

        // GET api/values 
        public IEnumerable<string> Get()
        {
            return new string[] { "Image", "jA0EAwMCxamDRMfOGV5gyZPnyX1BBPOQAE4BHbh7PfTDInn+94hXmnBr9D8+4x5RkNNl4E499Me3Fotq8/zvznEycz2h7vJ21SdP5akLhRPd4W1S79LoCvbZYh2x4t6xCnqev6S97ys4chOPgz0FePfKQos0I7+rrMSAc9+vXHmUCthFqp7FJJ7/D9bCfmdF1qkYNhtk/P5uvZ0N2zAUsiScDJA==XXuR" };
        }

        // GET api/values/5 
        public string Get(int id)
        {
            User u = new User();
            var userJson = JObject.FromObject(u);
            return userJson.ToString(Newtonsoft.Json.Formatting.None);
        }

        [HttpPost]
        public string CreateUser([FromBody]string value)
        {
            string returnValue = String.Empty;

            return returnValue;
        }

        //[HttpPost]
        //public JObject SendImage([FromBody]JValue value)
        //{
        //    return new JObject();
        //}

        [HttpPost]
        public JToken SendImage([FromBody]UserImage value)
        {
            if (!String.IsNullOrEmpty(value.CapturedImage))
            {
                var bytes = Convert.FromBase64String(value.CapturedImage);
                //using (var imageFile = new FileStream(@"C:\temp\Test.jpg", FileMode.Create))
                //{
                //    imageFile.Write(bytes, 0, bytes.Length);
                //    imageFile.Flush();
                //}
                JToken returnValue = null;
                try
                {
                    returnValue = AzureManager.MakeRequest(bytes).Result;
                    System.Console.WriteLine($"Captured image... happiness:{returnValue}");
                }
                catch (Exception ex)
                {
                    System.Console.WriteLine(ex.ToString());
                }
                
                return returnValue;
            }

            Response response = new Response()
            {
                Status = 200,
                Errors = new List<Error>() { new Error("", "") }
            };
            return JObject.FromObject(response);
        }

        // POST api/values 
        public void Post([FromBody]string value)
        {
            var hans = this.Request;
        }

        // PUT api/values/5 
        public void Put(int id, [FromBody]string value)
        {
        }

        // DELETE api/values/5 
        public void Delete(int id)
        {
        }
    }
}