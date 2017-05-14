using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Lpon.Console.WebLogic
{
    public class Response
    {
        public int Status { get; set; }

        public IEnumerable<Error> Errors { get; set; }

    }
}
