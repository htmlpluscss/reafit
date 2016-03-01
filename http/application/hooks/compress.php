<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Compression {
        // Variables
        protected $html;
        public function __construct($html) {
          if (!empty($html)) {
                $this->parseHTML($html);
            }
        }
        public function __toString() {
            return $this->html;
        }
        protected function bottomComment($raw, $compressed) {
            $raw = strlen($raw);
            $compressed = strlen($compressed);
            $savings = ($raw-$compressed) / $raw * 100;
            $savings = round($savings, 2);
            return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
        }
        protected function minifyHTML($html) {
            $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
            preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
            $overriding = false;
            $raw_tag = false;
            // Variable reused for output
            $html = '';
            foreach ($matches as $token) {
                $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
                $content = $token[0];
                if (is_null($tag)) {
                    if (!$overriding && $raw_tag != 'textarea') {
                        // Remove any HTML comments, except MSIE conditional comments
                        $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
                    }
                }
                else {
                    if ($tag == 'pre' || $tag == 'textarea') {
                        $raw_tag = $tag;
                    }
                    else if ($tag == '/pre' || $tag == '/textarea') {
                        $raw_tag = false;
                    }
                    else {
                        if ($raw_tag || $overriding) {
                            $strip = false;
                        }
                        else {
                            $strip = true;
                            // Remove any empty attributes, except:
                            // action, alt, content, src
                            $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
                            // Remove any space before the end of self-closing XHTML tags
                            // JavaScript excluded
                            $content = str_replace(' />', '/>', $content);

                        }
                    }
                }
                if ($strip) {
                    $content = $this->removeWhiteSpace($content);
                }

                $html .= $content;
            }

            $replace = array(
                        '> <' => '><',
                        ' >'  => '>',
                        '< '  => '<',
                        '</ ' => '</',
                        ' />' => '/>',
                        '> '  => '>',
                        ' <' => '<'
                    );
            $html = str_replace(array_keys($replace), array_values($replace), $html);

            return $html;
        }
        public function parseHTML($html) {
            $this->html = $this->minifyHTML($html);
            //$this->html .= "\n" . $this->bottomComment($html, $this->html);
        }
        protected function removeWhiteSpace($str) {
            $str = str_replace(array("\r\n", "\r"), "\n", $str);
            $str = str_replace("\t", ' ', $str);
            $str = str_replace("\n",  '', $str);
            $str = str_replace("\r",  '', $str);
            $str = preg_replace("/\s{2,}/", " ", $str);

            return $str;
        }
    }


function compress() {
    $CI = & get_instance();
    $buffer = $CI->output->get_output();

    $buffer = new Compression($buffer);

    $CI->output->set_output($buffer);
    $CI->output->_display();
}