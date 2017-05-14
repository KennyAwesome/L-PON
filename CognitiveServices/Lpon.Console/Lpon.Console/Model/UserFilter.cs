using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Lpon.Console.Model
{
    public  class UserFilter
    {
        public User User { get; set; }

        public Guid UserId { get; set; }

        public int Age { get; set; }

        public int[] Color { get; set; }

        public int Gender { get; set; }

        public int[] Occasion { get; set; }

        public int[] Style { get; set; }
    }
}
