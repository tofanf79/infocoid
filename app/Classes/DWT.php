<?php

namespace App\Classes;

class DWT
{
    public $path_dwt = '../public/dwt/';

    public function compress($source_file)
    {
        $level = 9;
        ini_set('memory_limit', '-1');
        $ext = pathinfo($source_file, PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        if ($ext == "png") {
            $im = imagecreatefrompng($source_file);
        } else if ($ext == "jpg" || $ext == "jpeg") {
            $im = imagecreatefromjpeg($source_file);
        } else if ($ext == "gif") {
            $im = imagecreatefromgif($source_file);
        } else {
            $im = imagecreatefromstring(file_get_contents($source_file));
        }

        $imagew = imagesx($im);
        $imageh = imagesy($im);

        if ($imagew == $imageh) {
            $level = 8;
        }

        $r1_array = array();
        $g1_array = array();
        $b1_array = array();

        for ($i = 0; $i < $imagew; $i++) { 
            for ($j = 0; $j < $imageh; $j++) {

                $rgb = ImageColorAt($im, $i, $j);

                $rr = ($rgb >> 16) & 0xFF;
                $gg = ($rgb >> 8) & 0xFF;
                $bb = $rgb & 0xFF;

                $r1_array[$i][$j] = $rr;
                $g1_array[$i][$j] = $gg;
                $b1_array[$i][$j] = $bb;

                $val = imagecolorallocate($im, $rr, $gg, $bb);
                imagesetpixel($im, $i, $j, $val);
            }
        }

        $r_array_dwt = $this->encode($r1_array, $level);
        $g_array_dwt = $this->encode($g1_array, $level);
        $b_array_dwt = $this->encode($b1_array, $level);

        $r_array_dwt_decompressed = $this->decode($r_array_dwt, $level, false);
        $g_array_dwt_decompressed = $this->decode($g_array_dwt, $level, false);
        $b_array_dwt_decompressed = $this->decode($b_array_dwt, $level, false);

        $im2 = imagecreatetruecolor($imagew, $imageh);

        $index = 0;
        for ($i = 0; $i < $imagew; $i++) {
            for ($j = 0; $j < $imageh; $j++) {
                $r_2 = ($r_array_dwt_decompressed[$i][$j]>255)?255:(($r_array_dwt_decompressed[$i][$j]<0)?0:$r_array_dwt_decompressed[$i][$j]);
                $g_2 = ($g_array_dwt_decompressed[$i][$j]>255)?255:(($g_array_dwt_decompressed[$i][$j]<0)?0:$g_array_dwt_decompressed[$i][$j]);
                $b_2 = ($b_array_dwt_decompressed[$i][$j]>255)?255:(($b_array_dwt_decompressed[$i][$j]<0)?0:$b_array_dwt_decompressed[$i][$j]);
                $rgb = imagecolorallocate($im2, 
                    $r_2, 
                    $g_2, 
                    $b_2
                );
                imagesetpixel($im2, $i, $j, $rgb);
                $index++;
            }
        }

        return $im2;
    }

    public function encode($channel, $level) {
        $height = count($channel);
        $width = count($channel[0]);
        $newChannel = array_fill(0, $height, array_fill(0, $width, 0.0));
    
        for ($j = 0; $j < $height; $j++) {
            for ($i = 0; $i < $width; $i++) {
                $newChannel[$j][$i] = ($channel[$j][$i])>=0?($channel[$j][$i]):-($channel[$j][$i]);
            }
        }
    
        $index = $height;
        $index2 = $width;
        $counter = 9 - $level;
        while ($counter > 0) {
            for ($i = 0; $i < $index2; $i++) {
                $subline = array_slice($newChannel[$i], 0, $index2);
                $subline = $this->decomposition($subline);
                array_splice($newChannel[$i], 0, $index, $subline);
            }
    
            for ($i = 0; $i < $index2; $i++) {
                $temp = array_fill(0, $index2, 0.0);
                for ($j = 0; $j < $index; $j++) {
                    $temp[$j] = $newChannel[$j][$i];
                }
                $temp = $this->decomposition($temp);
                for ($j = 0; $j < $index; $j++) {
                    $newChannel[$j][$i] = $temp[$j];
                }
            }
            $index = $index / 2;
            $index2 = $index2 / 2;
            $counter--;
        }
        return $newChannel;
    }

    function decomposition($line) {
        $result = array_slice($line, 0);
        for ($i = 0; $i < (count($line) / 2); $i++) {
            $result[$i] = ($line[$i * 2] + $line[$i * 2 + 1]) / 2;
            $result[count($line) / 2 + $i] = ($line[$i * 2] - $line[$i * 2 + 1]) / 2;
        }
        return $result;
    }

    function composition($line) {
        $result = array_slice($line, 0);
        for ($i = 0; $i < (count($line) / 2); $i++) {
            $result[$i * 2] = ($line[$i] + $line[count($line) / 2 + $i]);
            $result[$i * 2 + 1] = ($line[$i] - $line[count($line) / 2 + $i]);
        }
        return $result;
    }

    function zeroCoef($channel, $level) {
        $numCoeff = pow(2, $level);
        $height = count($channel);
        $width = count($channel[0]);
        for ($j = 0; $j < $height; $j++) {
            for ($i = 0; $i < $width; $i++) {
                if ($i >= $numCoeff || $j >= $numCoeff) {
                    $channel[$j][$i] = 0;
                }
            }
        }
        return $channel;
    }

    public function decode($enChannel, $level, $prog) {
        $height = count($enChannel);
        $width = count($enChannel[0]);
        $decoChannel = array_fill(0, $height, array_fill(0, $width, 0));
    
        if ($level != 9 && !$prog) {
            $enChannel = $this->zeroCoef($enChannel, $level);
        }
    
        $index = $height;
        $index2 = $width;
        
        $counter = 9 - $level;
        while ($counter > 0) {
            for ($i = 0; $i < $index2; $i++) {
                $temp = array_fill(0, $index, 0);
                for ($j = 0; $j < $index; $j++) {
                    $temp[$j] = $enChannel[$j][$i];
                }
                $temp = $this->composition($temp);
                for ($j = 0; $j < $index; $j++) {
                    $enChannel[$j][$i] = $temp[$j];
                }
            }
    
            for ($i = 0; $i < $index2; $i++) {
                $subline = array_fill(0, $index, 0);
                array_splice($subline, 0, $index, $enChannel[$i]);
                $subline = $this->composition($subline);
                array_splice($enChannel[$i], 0, $index, $subline);
            }
    
            $index = $index * 2;
            $index2 = $index2 * 2;
            $counter--;
        }
    
        for ($j = 0; $j < $height; $j++) {
            for ($i = 0; $i < $width; $i++) {
                $decoChannel[$j][$i] = (int)round($enChannel[$j][$i]);
            }
        }
    
        return $decoChannel;
    }
}