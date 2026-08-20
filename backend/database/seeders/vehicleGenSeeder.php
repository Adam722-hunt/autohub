<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class vehicleGenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicle_generations')->insert([
            ['name' => 'E120', 'model_id' => 1, 'from' => 2000, 'to' => 2007],
            ['name' => 'E140', 'model_id' => 1, 'from' => 2006, 'to' => 2013],
            ['name' => 'E170', 'model_id' => 1, 'from' => 2013, 'to' => 2019],
            ['name' => 'E210', 'model_id' => 1, 'from' => 2018, 'to' => null],
            
            ['name' => 'XV20', 'model_id' => 2, 'from' => 1996, 'to' => 2001],
            ['name' => 'XV30', 'model_id' => 2, 'from' => 2001, 'to' => 2006],
            ['name' => 'XV40', 'model_id' => 2, 'from' => 2006, 'to' => 2011],
            ['name' => 'XV50', 'model_id' => 2, 'from' => 2011, 'to' => 2017],
            ['name' => 'XV70', 'model_id' => 2, 'from' => 2017, 'to' => null],
            
            ['name' => 'XA10', 'model_id' => 3, 'from' => 1994, 'to' => 2000],
            ['name' => 'XA20', 'model_id' => 3, 'from' => 2000, 'to' => 2005],
            ['name' => 'XA30', 'model_id' => 3, 'from' => 2005, 'to' => 2012],
            ['name' => 'XA40', 'model_id' => 3, 'from' => 2012, 'to' => 2018],
            ['name' => 'XA50', 'model_id' => 3, 'from' => 2018, 'to' => null],
            
            ['name' => 'XU10', 'model_id' => 4, 'from' => 2000, 'to' => 2007],
            ['name' => 'XU20', 'model_id' => 4, 'from' => 2007, 'to' => 2013],
            ['name' => 'XU30', 'model_id' => 4, 'from' => 2013, 'to' => 2019],
            ['name' => 'XU50', 'model_id' => 4, 'from' => 2019, 'to' => null],
            
            ['name' => 'N140', 'model_id' => 5, 'from' => 1995, 'to' => 2004],
            ['name' => 'N160', 'model_id' => 5, 'from' => 2004, 'to' => 2015],
            ['name' => 'N220', 'model_id' => 5, 'from' => 2015, 'to' => null],
            
            ['name' => 'XK30', 'model_id' => 11, 'from' => 1993, 'to' => 2002],
            ['name' => 'A90', 'model_id' => 11, 'from' => 2019, 'to' => null],
            
            ['name' => 'CG', 'model_id' => 12, 'from' => 1993, 'to' => 1997],
            ['name' => 'CF', 'model_id' => 12, 'from' => 1997, 'to' => 2002],
            ['name' => 'CL', 'model_id' => 12, 'from' => 2002, 'to' => 2007],
            ['name' => 'CP', 'model_id' => 12, 'from' => 2007, 'to' => 2012],
            ['name' => 'CV1', 'model_id' => 12, 'from' => 2012, 'to' => 2017],
            ['name' => 'CV2', 'model_id' => 12, 'from' => 2017, 'to' => null],
            
            ['name' => 'EG', 'model_id' => 13, 'from' => 1991, 'to' => 1995],
            ['name' => 'EK', 'model_id' => 13, 'from' => 1995, 'to' => 2000],
            ['name' => 'EM', 'model_id' => 13, 'from' => 2000, 'to' => 2005],
            ['name' => 'FD', 'model_id' => 13, 'from' => 2005, 'to' => 2011],
            ['name' => 'FB', 'model_id' => 13, 'from' => 2011, 'to' => 2015],
            ['name' => 'FC', 'model_id' => 13, 'from' => 2015, 'to' => 2021],
            ['name' => 'FE', 'model_id' => 13, 'from' => 2021, 'to' => null],
            
            ['name' => 'RD1', 'model_id' => 14, 'from' => 1995, 'to' => 2001],
            ['name' => 'RD4', 'model_id' => 14, 'from' => 2001, 'to' => 2006],
            ['name' => 'RE', 'model_id' => 14, 'from' => 2006, 'to' => 2011],
            ['name' => 'RM', 'model_id' => 14, 'from' => 2011, 'to' => 2016],
            ['name' => 'RW', 'model_id' => 14, 'from' => 2016, 'to' => null],
            
            ['name' => 'L30', 'model_id' => 20, 'from' => 1997, 'to' => 2001],
            ['name' => 'L31', 'model_id' => 20, 'from' => 2001, 'to' => 2006],
            ['name' => 'L32', 'model_id' => 20, 'from' => 2006, 'to' => 2012],
            ['name' => 'L33', 'model_id' => 20, 'from' => 2012, 'to' => 2018],
            ['name' => 'L34', 'model_id' => 20, 'from' => 2018, 'to' => null],
            
            ['name' => 'Z31', 'model_id' => 21, 'from' => 1983, 'to' => 1989],
            ['name' => 'Z32', 'model_id' => 21, 'from' => 1989, 'to' => 1994],
            ['name' => 'A32', 'model_id' => 21, 'from' => 1994, 'to' => 1999],
            ['name' => 'A33', 'model_id' => 21, 'from' => 1999, 'to' => 2003],
            ['name' => 'A34', 'model_id' => 21, 'from' => 2003, 'to' => 2008],
            ['name' => 'A35', 'model_id' => 21, 'from' => 2008, 'to' => 2014],
            ['name' => 'A36', 'model_id' => 21, 'from' => 2015, 'to' => null],
            
            ['name' => 'J10', 'model_id' => 22, 'from' => 2007, 'to' => 2013],
            ['name' => 'J11', 'model_id' => 22, 'from' => 2013, 'to' => 2020],
            ['name' => 'J12', 'model_id' => 22, 'from' => 2020, 'to' => null],
            
            ['name' => 'P1', 'model_id' => 29, 'from' => 1996, 'to' => 2004],
            ['name' => 'P2', 'model_id' => 29, 'from' => 2004, 'to' => 2008],
            ['name' => 'P3', 'model_id' => 29, 'from' => 2008, 'to' => 2014],
            ['name' => 'P4', 'model_id' => 29, 'from' => 2014, 'to' => 2020],
            ['name' => 'P5', 'model_id' => 29, 'from' => 2020, 'to' => null],
            
            ['name' => 'S197', 'model_id' => 30, 'from' => 2004, 'to' => 2014],
            ['name' => 'S550', 'model_id' => 30, 'from' => 2014, 'to' => 2023],
            ['name' => 'S650', 'model_id' => 30, 'from' => 2023, 'to' => null],
            
            ['name' => 'U1', 'model_id' => 31, 'from' => 2000, 'to' => 2007],
            ['name' => 'U2', 'model_id' => 31, 'from' => 2007, 'to' => 2012],
            ['name' => 'U3', 'model_id' => 31, 'from' => 2012, 'to' => 2019],
            ['name' => 'U4', 'model_id' => 31, 'from' => 2019, 'to' => null],
            
            ['name' => 'E30', 'model_id' => 48, 'from' => 1982, 'to' => 1994],
            ['name' => 'E36', 'model_id' => 48, 'from' => 1990, 'to' => 2000],
            ['name' => 'E46', 'model_id' => 48, 'from' => 1997, 'to' => 2006],
            ['name' => 'E90', 'model_id' => 48, 'from' => 2004, 'to' => 2013],
            ['name' => 'F30', 'model_id' => 48, 'from' => 2011, 'to' => 2019],
            ['name' => 'G20', 'model_id' => 48, 'from' => 2018, 'to' => null],
            
            ['name' => 'E28', 'model_id' => 49, 'from' => 1981, 'to' => 1988],
            ['name' => 'E34', 'model_id' => 49, 'from' => 1987, 'to' => 1996],
            ['name' => 'E39', 'model_id' => 49, 'from' => 1995, 'to' => 2003],
            ['name' => 'E60', 'model_id' => 49, 'from' => 2003, 'to' => 2010],
            ['name' => 'F10', 'model_id' => 49, 'from' => 2009, 'to' => 2016],
            ['name' => 'G30', 'model_id' => 49, 'from' => 2016, 'to' => null],
            
            ['name' => 'E23', 'model_id' => 50, 'from' => 1977, 'to' => 1986],
            ['name' => 'E32', 'model_id' => 50, 'from' => 1986, 'to' => 1994],
            ['name' => 'E38', 'model_id' => 50, 'from' => 1994, 'to' => 2001],
            ['name' => 'E65', 'model_id' => 50, 'from' => 2001, 'to' => 2008],
            ['name' => 'F01', 'model_id' => 50, 'from' => 2008, 'to' => 2015],
            ['name' => 'G11', 'model_id' => 50, 'from' => 2015, 'to' => null],
            
            ['name' => 'W202', 'model_id' => 58, 'from' => 1993, 'to' => 2000],
            ['name' => 'W203', 'model_id' => 58, 'from' => 2000, 'to' => 2007],
            ['name' => 'W204', 'model_id' => 58, 'from' => 2007, 'to' => 2014],
            ['name' => 'W205', 'model_id' => 58, 'from' => 2014, 'to' => 2021],
            ['name' => 'W206', 'model_id' => 58, 'from' => 2021, 'to' => null],
            
            ['name' => 'W124', 'model_id' => 59, 'from' => 1984, 'to' => 1995],
            ['name' => 'W210', 'model_id' => 59, 'from' => 1995, 'to' => 2002],
            ['name' => 'W211', 'model_id' => 59, 'from' => 2002, 'to' => 2009],
            ['name' => 'W212', 'model_id' => 59, 'from' => 2009, 'to' => 2016],
            ['name' => 'W213', 'model_id' => 59, 'from' => 2016, 'to' => null],
            
            ['name' => 'W126', 'model_id' => 60, 'from' => 1979, 'to' => 1991],
            ['name' => 'W140', 'model_id' => 60, 'from' => 1991, 'to' => 1998],
            ['name' => 'W220', 'model_id' => 60, 'from' => 1998, 'to' => 2005],
            ['name' => 'W221', 'model_id' => 60, 'from' => 2005, 'to' => 2013],
            ['name' => 'W222', 'model_id' => 60, 'from' => 2013, 'to' => 2020],
            ['name' => 'W223', 'model_id' => 60, 'from' => 2020, 'to' => null],
            
            ['name' => '8L', 'model_id' => 68, 'from' => 1996, 'to' => 2003],
            ['name' => '8P', 'model_id' => 68, 'from' => 2003, 'to' => 2012],
            ['name' => '8V', 'model_id' => 68, 'from' => 2012, 'to' => 2020],
            ['name' => '8Y', 'model_id' => 68, 'from' => 2020, 'to' => null],
            
            ['name' => 'B5', 'model_id' => 69, 'from' => 1994, 'to' => 2001],
            ['name' => 'B6', 'model_id' => 69, 'from' => 2000, 'to' => 2005],
            ['name' => 'B7', 'model_id' => 69, 'from' => 2004, 'to' => 2008],
            ['name' => 'B8', 'model_id' => 69, 'from' => 2007, 'to' => 2015],
            ['name' => 'B9', 'model_id' => 69, 'from' => 2015, 'to' => null],
            
            ['name' => 'C4', 'model_id' => 70, 'from' => 1991, 'to' => 1997],
            ['name' => 'C5', 'model_id' => 70, 'from' => 1997, 'to' => 2004],
            ['name' => 'C6', 'model_id' => 70, 'from' => 2004, 'to' => 2011],
            ['name' => 'C7', 'model_id' => 70, 'from' => 2011, 'to' => 2018],
            ['name' => 'C8', 'model_id' => 70, 'from' => 2018, 'to' => null],
            
            ['name' => '964', 'model_id' => 148, 'from' => 1989, 'to' => 1994],
            ['name' => '993', 'model_id' => 148, 'from' => 1993, 'to' => 1998],
            ['name' => '996', 'model_id' => 148, 'from' => 1997, 'to' => 2004],
            ['name' => '997', 'model_id' => 148, 'from' => 2004, 'to' => 2012],
            ['name' => '991', 'model_id' => 148, 'from' => 2011, 'to' => 2019],
            ['name' => '992', 'model_id' => 148, 'from' => 2019, 'to' => null],
            
            ['name' => 'E1', 'model_id' => 149, 'from' => 2002, 'to' => 2010],
            ['name' => 'E2', 'model_id' => 149, 'from' => 2010, 'to' => 2017],
            ['name' => 'E3', 'model_id' => 149, 'from' => 2017, 'to' => null],
            
            ['name' => '95B', 'model_id' => 150, 'from' => 2014, 'to' => null],
            
            ['name' => '1st Gen', 'model_id' => 127, 'from' => 2012, 'to' => 2016],
            ['name' => '2nd Gen', 'model_id' => 127, 'from' => 2016, 'to' => 2021],
            ['name' => '3rd Gen', 'model_id' => 127, 'from' => 2021, 'to' => null],
            
            ['name' => '1st Gen', 'model_id' => 128, 'from' => 2017, 'to' => 2023],
            ['name' => '2nd Gen', 'model_id' => 128, 'from' => 2023, 'to' => null],
            
            ['name' => '1st Gen', 'model_id' => 129, 'from' => 2015, 'to' => null],
            
            ['name' => '1st Gen', 'model_id' => 130, 'from' => 2020, 'to' => null],
            
            ['name' => 'M600', 'model_id' => 194, 'from' => 1993, 'to' => 2001],
            ['name' => 'M620', 'model_id' => 194, 'from' => 2001, 'to' => 2008],
            ['name' => 'M696', 'model_id' => 194, 'from' => 2008, 'to' => 2014],
            ['name' => 'M821', 'model_id' => 194, 'from' => 2014, 'to' => 2020],
            ['name' => 'M937', 'model_id' => 194, 'from' => 2020, 'to' => null],
            
            ['name' => '899', 'model_id' => 195, 'from' => 2013, 'to' => 2015],
            ['name' => '959', 'model_id' => 195, 'from' => 2016, 'to' => 2018],
            ['name' => 'V2', 'model_id' => 195, 'from' => 2018, 'to' => null],
            ['name' => 'V4', 'model_id' => 195, 'from' => 2018, 'to' => null],
            
            ['name' => 'RN01', 'model_id' => 200, 'from' => 1998, 'to' => 2003],
            ['name' => 'RN04', 'model_id' => 200, 'from' => 2003, 'to' => 2006],
            ['name' => 'RN07', 'model_id' => 200, 'from' => 2006, 'to' => 2008],
            ['name' => 'RN12', 'model_id' => 200, 'from' => 2008, 'to' => 2014],
            ['name' => 'RN19', 'model_id' => 200, 'from' => 2015, 'to' => 2020],
            ['name' => 'RN31', 'model_id' => 200, 'from' => 2020, 'to' => null],
            
            ['name' => 'MT-07', 'model_id' => 202, 'from' => 2013, 'to' => null],
            
            ['name' => 'MT-09', 'model_id' => 203, 'from' => 2013, 'to' => 2020],
            ['name' => 'MT-09 Gen 2', 'model_id' => 203, 'from' => 2020, 'to' => null],
            
            ['name' => 'FLHX', 'model_id' => 208, 'from' => 2006, 'to' => 2014],
            ['name' => 'FLHX Gen 2', 'model_id' => 208, 'from' => 2014, 'to' => null],
            
            ['name' => 'FLHR', 'model_id' => 209, 'from' => 1994, 'to' => 2007],
            ['name' => 'FLHR Gen 2', 'model_id' => 209, 'from' => 2007, 'to' => null],
            
            ['name' => 'ZX-10R', 'model_id' => 214, 'from' => 2004, 'to' => 2007],
            ['name' => 'ZX-10R Gen 2', 'model_id' => 214, 'from' => 2008, 'to' => 2010],
            ['name' => 'ZX-10R Gen 3', 'model_id' => 214, 'from' => 2011, 'to' => 2015],
            ['name' => 'ZX-10R Gen 4', 'model_id' => 214, 'from' => 2016, 'to' => 2020],
            ['name' => 'ZX-10R Gen 5', 'model_id' => 214, 'from' => 2020, 'to' => null],
            
            ['name' => 'GSX-R1000', 'model_id' => 220, 'from' => 2000, 'to' => 2004],
            ['name' => 'GSX-R1000 Gen 2', 'model_id' => 220, 'from' => 2005, 'to' => 2008],
            ['name' => 'GSX-R1000 Gen 3', 'model_id' => 220, 'from' => 2009, 'to' => 2016],
            ['name' => 'GSX-R1000 Gen 4', 'model_id' => 220, 'from' => 2017, 'to' => null],
            
            ['name' => 'Hayabusa Gen 1', 'model_id' => 223, 'from' => 1999, 'to' => 2007],
            ['name' => 'Hayabusa Gen 2', 'model_id' => 223, 'from' => 2008, 'to' => 2020],
            ['name' => 'Hayabusa Gen 3', 'model_id' => 223, 'from' => 2021, 'to' => null],
            
            ['name' => 'CBR1000RR', 'model_id' => 225, 'from' => 2004, 'to' => 2007],
            ['name' => 'CBR1000RR Gen 2', 'model_id' => 225, 'from' => 2008, 'to' => 2016],
            ['name' => 'CBR1000RR Gen 3', 'model_id' => 225, 'from' => 2017, 'to' => 2020],
            ['name' => 'CBR1000RR-R', 'model_id' => 225, 'from' => 2020, 'to' => null],
            
            ['name' => 'CRF450L', 'model_id' => 227, 'from' => 2018, 'to' => null],
            
            ['name' => 'Africa Twin', 'model_id' => 228, 'from' => 2015, 'to' => null],
            
            ['name' => 'Domane Gen 1', 'model_id' => 293, 'from' => 2012, 'to' => 2016],
            ['name' => 'Domane Gen 2', 'model_id' => 293, 'from' => 2016, 'to' => 2020],
            ['name' => 'Domane Gen 3', 'model_id' => 293, 'from' => 2020, 'to' => null],
            
            ['name' => 'Emonda Gen 1', 'model_id' => 294, 'from' => 2014, 'to' => 2018],
            ['name' => 'Emonda Gen 2', 'model_id' => 294, 'from' => 2018, 'to' => null],
            
            ['name' => 'Madone Gen 1', 'model_id' => 295, 'from' => 2003, 'to' => 2008],
            ['name' => 'Madone Gen 2', 'model_id' => 295, 'from' => 2008, 'to' => 2013],
            ['name' => 'Madone Gen 3', 'model_id' => 295, 'from' => 2013, 'to' => 2019],
            ['name' => 'Madone Gen 4', 'model_id' => 295, 'from' => 2019, 'to' => null],
            
            ['name' => 'Marlin Gen 1', 'model_id' => 297, 'from' => 2010, 'to' => 2016],
            ['name' => 'Marlin Gen 2', 'model_id' => 297, 'from' => 2016, 'to' => null],
            
            ['name' => 'Defy Gen 1', 'model_id' => 299, 'from' => 2007, 'to' => 2012],
            ['name' => 'Defy Gen 2', 'model_id' => 299, 'from' => 2012, 'to' => 2018],
            ['name' => 'Defy Gen 3', 'model_id' => 299, 'from' => 2018, 'to' => null],
            
            ['name' => 'TCR Gen 1', 'model_id' => 300, 'from' => 1997, 'to' => 2003],
            ['name' => 'TCR Gen 2', 'model_id' => 300, 'from' => 2003, 'to' => 2008],
            ['name' => 'TCR Gen 3', 'model_id' => 300, 'from' => 2008, 'to' => 2015],
            ['name' => 'TCR Gen 4', 'model_id' => 300, 'from' => 2015, 'to' => null],
            
            ['name' => 'Tarmac Gen 1', 'model_id' => 304, 'from' => 2003, 'to' => 2008],
            ['name' => 'Tarmac Gen 2', 'model_id' => 304, 'from' => 2008, 'to' => 2013],
            ['name' => 'Tarmac Gen 3', 'model_id' => 304, 'from' => 2013, 'to' => 2019],
            ['name' => 'Tarmac Gen 4', 'model_id' => 304, 'from' => 2019, 'to' => null],
            
            ['name' => 'Stumpjumper Gen 1', 'model_id' => 306, 'from' => 1990, 'to' => 1995],
            ['name' => 'Stumpjumper Gen 2', 'model_id' => 306, 'from' => 1995, 'to' => 2000],
            ['name' => 'Stumpjumper Gen 3', 'model_id' => 306, 'from' => 2000, 'to' => 2005],
            ['name' => 'Stumpjumper Gen 4', 'model_id' => 306, 'from' => 2005, 'to' => 2010],
            ['name' => 'Stumpjumper Gen 5', 'model_id' => 306, 'from' => 2010, 'to' => 2015],
            ['name' => 'Stumpjumper Gen 6', 'model_id' => 306, 'from' => 2015, 'to' => null],
            
            ['name' => '4 Series', 'model_id' => 254, 'from' => 1995, 'to' => 2004],
            ['name' => 'PGR Series', 'model_id' => 254, 'from' => 2004, 'to' => 2013],
            ['name' => 'Next Gen', 'model_id' => 254, 'from' => 2013, 'to' => 2018],
            ['name' => 'S/R Series', 'model_id' => 254, 'from' => 2018, 'to' => null],
            
            ['name' => 'FH Gen 1', 'model_id' => 258, 'from' => 1993, 'to' => 2001],
            ['name' => 'FH Gen 2', 'model_id' => 258, 'from' => 2001, 'to' => 2008],
            ['name' => 'FH Gen 3', 'model_id' => 258, 'from' => 2008, 'to' => 2015],
            ['name' => 'FH Gen 4', 'model_id' => 258, 'from' => 2015, 'to' => null],
            
            ['name' => 'Actros MP1', 'model_id' => 263, 'from' => 1996, 'to' => 2003],
            ['name' => 'Actros MP2', 'model_id' => 263, 'from' => 2003, 'to' => 2008],
            ['name' => 'Actros MP3', 'model_id' => 263, 'from' => 2008, 'to' => 2011],
            ['name' => 'Actros MP4', 'model_id' => 263, 'from' => 2011, 'to' => null],
            
            ['name' => 'F Series Gen 1', 'model_id' => 280, 'from' => 2000, 'to' => 2005],
            ['name' => 'F Series Gen 2', 'model_id' => 280, 'from' => 2005, 'to' => 2010],
            ['name' => 'F Series Gen 3', 'model_id' => 280, 'from' => 2010, 'to' => 2015],
            ['name' => 'F Series Gen 4', 'model_id' => 280, 'from' => 2015, 'to' => null],
            
            ['name' => 'Verado Gen 1', 'model_id' => 284, 'from' => 2004, 'to' => 2010],
            ['name' => 'Verado Gen 2', 'model_id' => 284, 'from' => 2010, 'to' => 2016],
            ['name' => 'Verado Gen 3', 'model_id' => 284, 'from' => 2016, 'to' => null],
        ]);
    }
}