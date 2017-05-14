using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Lpon.Console.WebLogic
{
    public class Error
    {
        public string Code { get; set; }

        public string Msg { get; set; }

        public Error(string code, string msg)
        {
            Code = code;
            Msg = msg;
        }
    }
}
