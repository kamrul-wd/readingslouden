<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'parent_id' => null,
                'heading' => 'Home',
                'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                'template' => 'home',
                'child_template' => '',
                'on_main_nav' => 1,
                'slug' => '',
                'active' => 1,
            ],
            [
                'parent_id' => 1,
                'heading' => 'About',
                'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                'template' => 'defaultLayout',
                'child_template' => '',
                'on_main_nav' => 1,
                'slug' => 'about',
                'active' => 1,
            ],
            [
                'parent_id' => 1,
                'heading' => 'Contact',
                'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                'template' => 'defaultLayout',
                'child_template' => '',
                'on_main_nav' => 1,
                'slug' => 'contact',
                'active' => 1,
            ],
            [
                'parent_id' => 1,
                'heading' => 'Team',
                'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                'template' => 'team',
                'child_template' => 'teamMember',
                'on_main_nav' => 1,
                'slug' => 'team',
                'active' => 1,
            ],
                [
                    'parent_id' => 4,
                    'heading' => 'Team Member 1',
                    'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                    'template' => 'team',
                    'child_template' => '',
                    'on_main_nav' => 1,
                    'slug' => 'team-member-1',
                    'active' => 1,
                ],
                [
                    'parent_id' => 4,
                    'heading' => 'Team Member 2',
                    'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                    'template' => 'team',
                    'child_template' => '',
                    'on_main_nav' => 1,
                    'slug' => 'team-member-2',
                    'active' => 1,
                ],
            [
                'parent_id' => 1,
                'heading' => 'News',
                'content' => 'this is also content about content',
                'template' => 'news',
                'child_template' => 'newsArticle',
                'on_main_nav' => 1,
                'slug' => 'news',
                'active' => 1,
            ],
                [
                    'parent_id' => 7,
                    'heading' => 'News Article 1',
                    'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                    'template' => '',
                    'child_template' => '',
                    'on_main_nav' => 1,
                    'slug' => 'news-article-1',
                    'active' => 1,
                ],
                [
                    'parent_id' => 7,
                    'heading' => 'News Article 2',
                    'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                    'template' => '',
                    'child_template' => '',
                    'on_main_nav' => 1,
                    'slug' => 'news-article-2',
                    'active' => 1,
                ],
                [
                    'parent_id' => 7,
                    'heading' => 'News Article 3',
                    'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                    'template' => '',
                    'child_template' => '',
                    'on_main_nav' => 1,
                    'slug' => 'news-article-3',
                    'active' => 1,
                ],
                [
                    'parent_id' => 7,
                    'heading' => 'News Article 4',
                    'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                    'template' => '',
                    'child_template' => '',
                    'on_main_nav' => 1,
                    'slug' => 'news-article-4',
                    'active' => 1,
                ],
                [
                    'parent_id' => 7,
                    'heading' => 'News Article 5',
                    'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                    'template' => '',
                    'child_template' => '',
                    'on_main_nav' => 1,
                    'slug' => 'news-article-5',
                    'active' => 1,
                ],
            [
                'parent_id' => 1,
                'heading' => 'Products',
                'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                'template' => 'product',
                'child_template' => 'productCategories',
                'on_main_nav' => 1,
                'slug' => 'product',
                'active' => 1,
            ],
                [
                    'parent_id' => 13,
                    'heading' => 'Men',
                    'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                    'template' => '',
                    'child_template' => 'productItems',
                    'on_main_nav' => 1,
                    'slug' => 'men',
                    'active' => 1,
                ],
                    [
                        'parent_id' => 14,
                        'heading' => 'Trousers',
                        'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                        'template' => '',
                        'child_template' => '',
                        'on_main_nav' => 1,
                        'slug' => 'trousers',
                        'active' => 1,
                    ],
                    [
                        'parent_id' => 14,
                        'heading' => 'Jumpers',
                        'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                        'template' => '',
                        'child_template' => '',
                        'on_main_nav' => 1,
                        'slug' => 'jumpers',
                        'active' => 1,
                    ],
                [
                    'parent_id' => 13,
                    'heading' => 'Women',
                    'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                    'template' => '',
                    'child_template' => '',
                    'on_main_nav' => 1,
                    'slug' => 'women',
                    'active' => 1,
                ],
                    [
                        'parent_id' => 17,
                        'heading' => 'Trousers',
                        'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                        'template' => '',
                        'child_template' => '',
                        'on_main_nav' => 1,
                        'slug' => 'trousers',
                        'active' => 1,
                    ],
                    [
                        'parent_id' => 17,
                        'heading' => 'Jumpers',
                        'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                        'template' => '',
                        'child_template' => '',
                        'on_main_nav' => 1,
                        'slug' => 'jumpers',
                        'active' => 1,
                    ],
            [
                'parent_id' => 1,
                'heading' => 'Legal',
                'content' => 'Ex quas intellegam signiferumque mel, eam ea debet minimum appellantur. Id sed nisl fabulas detracto, noluisse deseruisse consetetur vix ad, pri adhuc blandit et. Vis bonorum laboramus ad. No eum saepe causae scribentur, cu aliquip habemus vel. Minim utinam iracundia usu te, ad hinc aliquip eam, ea libris erroribus eloquentiam eum.',
                'template' => 'defaultLayout',
                'child_template' => '',
                'on_main_nav' => 0,
                'slug' => 'legal',
                'active' => 1,
            ],
            [
                'parent_id' => 20,
                'heading' => 'Terms And Conditions',
                'content' => '<p>These terms and conditions apply to the use of this website (the &quot;Website&quot;).
                              Please read these terms and conditions carefully. Your use of the Website is confirmation that you have understood and agreed to be bound by all of these terms and conditions.
                              ##COMPANYNAME## may suspend your use of this site immediately if you do not comply with these terms and conditions.</p>
                              <p>The Website is communicated by and is the property of  ##COMPANYNAME##, and all the material on this Website is subject to copyright with all rights reserved.</p>
                              <h2>Use of the Website</h2>
                              <p>Users may not link any other website to the Website without obtaining the prior written consent of  ##COMPANYNAME##.
                              Users must also not use the Website in a way which causes or may cause:</p>
                              <ul><li> the Website or the service offered to be interrupted, damaged or impaired;</li>
                              <li>offence or detriment to any other person who uses the Website or any services offered;</li>
                              <li> ##COMPANYNAME##, you or any other user of the Website to be in breach of applicable law or regulatio; or</li>
                              <li>detriment to any person who supplies services to  ##COMPANYNAME## in connection with the Website.</li></ul>
                              <p> Access to the Website is not open to persons resident in, or citizens of, any territory outside of the United Kingdom
                              where to allow such access would require any registration, filing, application for any license or approval or other steps to be taken by
                              ##COMPANYNAME## in order to comply with local laws or other regulatory requirements in such overseas territory. We make no representation that any material contained on this Website
                              is appropriate for any jurisdiction other than the United Kingdom. The server on which this Website is maintained is located in England and the information delivered via the site is
                              deemed to have been delivered in England.</p>
                              <h2>No Offer</h2>
                              <p>The Website is for informational purposes only. Nothing in the Website should be construed as an offer, invitation or general solicitation to buy or sell any investments or securities,
                              provide investment advisory services or to engage in any other transaction, and must not be relied upon in connection with any investment decision.</p>
                              <h2>No Advice</h2>
                              <p>The information on the Website, including all opinions or other content, is not intended to and does not constitute financial,
                              accounting, tax, legal, investment, consulting or other professional advice or services, but is for information purposes only.</p>
                              <h2>Disclaimer</h2>
                              <p>No warranty, condition or undertaking or term, either express or implied, is given that the information or opinions contained in this website are accurate,
                              reliable or complete or as to the freedom of this site from defects, viruses, malicious programs or macro or as to the appropriateness of the content of the Website for any use which the recipient may choose to make of it.
                              The information published on the Website is provided as a convenience to visitors and should be used for informational purposes only and is subject to change without notice. If you require additional information,
                              you should contact appropriate  ##COMPANYNAME## personnel.</p>
                              <p>YOU ACKNOWLEDGE THAT YOU ARE SOLELY RESPONSIBLE FOR THE USE TO WHICH YOU PUT THE WEBSITE AND ALL THE INFORMATION YOU OBTAIN FROM IT AND THAT ALL WARRANTIES, CONDITIONS, UNDERTAKINGS, REPRESENTATIONS AND TERMS,
                              WHETHER EXPRESS OR IMPLIED, STATUTORY OR OTHERWISE, ARE HEREBY EXCLUDED TO THE FULLEST EXTENT PERMITTED BY LAW.</p>
                              <p>Save in respect of liability for death or personal injury arising out of negligence or for fraudulent misrepresentation, we and all contributors to the Website hereby disclaim to the fullest extent permitted
                              by law all liability for any loss or damage including any direct, special, consequential or indirect or punitive damages, losses, costs or expenses and any loss of profit incurred by you, whether arising in tort,
                              contract or otherwise, and arising out of or in connection with your access to or use of, or inability to use, the Website or use of any material on the Website even if we have been advised of the possibility of such damage.
                              In addition, no liability can be accepted by us in respect of any changes made to the content of this Website by unauthorised third parties.</p>
                              <p>In addition, any software which may be offered by the site from time to time is downloaded at your own risk. If you are in any doubt as to the suitability of this software for your computer,
                              it is recommended that you obtain specialist advice before downloading it.</p>
                              <p>We provide no warranty that the Website will be available at any time. We will attempt to correct all faults as soon as we reasonably can.  ##COMPANYNAME## makes no representations or warranties in particular as to the accuracy,
                              currency or completeness of any information contained on the Website and may change the information at any time without notice.</p>
                              <h2>Copyright</h2>
                              <p>The content of the Website is subject to copyright with all rights reserved. The copyright and all other rights in all of the material on the Website (including without limitation the screen displays, the content, the text,
                              graphics and look and feel of the site) are owned by  ##COMPANYNAME## and its licensors. You may download or print out a hard copy of such individual pages and/or sections of the Website as you may reasonably require provided that this is for private,
                              non-commercial or domestic use only and that you do not remove any copyright or other proprietary notices. Any downloading or other copying from the Website will not transfer title to any software or material to you. You may not reproduce (in whole or in part),
                              transmit (by electronic means or otherwise), modify, link into or use for any public or commercial purpose the Website without our prior written permission. Any unauthorised reproduction or use of the Website or the information
                              presented therein may be the subject of prosecution, particularly for infringement of copyright. Any rights not expressly granted in these terms are reserved.</p>
                              <h2>Links to External Sites</h2>
                              <p>The Website may contain links to or from other websites over which  ##COMPANYNAME## has no control. These linked sites are for your convenience only and you access them at your own risk. We are not responsible for the content of any linked sites.
                              We do not in any way endorse the linked sites. Links to the Website may not be included in any other website without the prior written consent of  ##COMPANYNAME##. We will not be responsible for the content of any advertising that may appear on our site
                               nor for its compliance with any applicable laws or regulations.</p>
                               <h2>Security</h2>
                               <p>You should be aware that the internet, being an open network, is not secure. If you choose to send any electronic communications to us by means of this Website, you do so at your own risk. We cannot guarantee that such communications will not be
                               intercepted or changed or that they will reach the intended recipient safely.</p>
                               <h2>No Representation or Warranty</h2>
                               <p>No representation, warranty or guarantee or any kind, express or implied, is given by  ##COMPANYNAME##.</p>
                               <h2>Content</h2>
                               <p>While we use reasonable endeavours to obtain information from sources which we believe to be reliable and to ensure that the information on the Website is up to date and accurate,  ##COMPANYNAME## makes no representation or warranty that the
                               information or opinions contained on the Website are accurate, reliable or complete. The information and opinions contained on the Website are provided by  ##COMPANYNAME## for personal use and for informational purposes only. You are solely liable for
                               any use you may make of this information.  ##COMPANYNAME## makes no representation, warranty, condition, undertaking or term, whether express or implied, as to the condition, quality, performance, accuracy, suitability, fitness for purpose, completeness
                               or freedom from viruses of the content contained on the Website or that such content will be accurate, up to date, uninterrupted or error fee. Whilst we take every care to ensure that the standard of the Website remains high and to maintain the continuity of it,
                               the internet is not always a stable medium and errors, omissions, interruptions of service and delays may occur at any time, for which  ##COMPANYNAME## accepts no responsibility.</p>
                               <h2>Changes to the Terms</h2>
                               <p>Changes are periodically made to the information on the Website and to these terms and conditions and these changes will be incorporated in new editions of this site. ##COMPANYNAME## reserves the right to alter or amend any information set out in the Website
                               and these terms and conditions without notice. If you use the Website after  ##COMPANYNAME## has posted the changes, you will be bound by the new terms. You should therefore ensure that you read the terms and conditions each time you use the Website.</p>
                               <h2>Trademarks</h2>
                               <p> ##COMPANYNAME## does not give persons accessing the Website permission to use any trade mark contained in the Website. Unauthorised use may constitute an infringement of the relevant owner\'s rights.</p>
                               <h2>Severability</h2>
                               <p>If any part of these terms and conditions is, at any time, found to be invalid by a court, tribunal or other forum of competent jurisdiction, or otherwise rendered unenforceable, that decision shall not invalidate or void the remainder of these terms and conditions.
                               These terms and conditions shall be deemed amended by modifying or severing such part as necessary to render them valid, legal and enforceable whilst preserving their intent or, if that is not possible, by substituting another provision that is valid,
                               legal and enforceable that gives equivalent effect to the parties intent. Any such invalid or unenforceable part or parts shall be severable from these terms and conditions in any other jurisdiction and the validity of the part(s) in question shall not be affected thereby.</p>
                               <h2>Assignment</h2>
                               <p>You may not assign, sub-licence or otherwise transfer any of your rights under these terms and conditions.</p>
                               <h2>Government Law and Jurisdiction</h2>
                               <p>These terms and conditions, your use of the Website, and all matters connected with them (whether contractual or non-contractual) are governed by and shall be construed in accordance with the law of England and Wales and shall be subject to the exclusive jurisdiction of the English courts.
                               If you access the Website from outside the UK you are responsible for ensuring compliance with any local laws relating to access.',
                'template' => 'defaultLayout',
                'child_template' => '',
                'on_main_nav' => 0,
                'slug' => 'terms-conditions',
                'active' => 1,
            ],
            [
                'parent_id' => 20,
                'heading' => 'Privacy',
                'content' => '<p>This privacy policy sets out how ##COMPANYNAME## uses and protects any information that you give ##COMPANYNAME## when you use this website.</p>
                              <p>##COMPANYNAME## is committed to ensuring that your privacy is protected. Should we ask you to provide certain information by which you can be identified when using this website, then you can be assured that it will only be used in accordance with this privacy statement.</p>
                              <p>##COMPANYNAME## may change this policy from time to time by updating this page. You should check this page from time to time to ensure that you are happy with any changes.</p>
                              <h2>What we collect</h2>
                              <p>We may collect the following information:</p><ul><li>name and job title</li><li>contact information including email address</li>
                              <li>demographic information such as postcode, preferences and interests</li><li>other information relevant to customer surveys and/or offers</li></ul>
                              <h2>What we do with the information we gather</h2>
                              <p>We require this information to understand your needs and provide you with a better service, and in particular for the following reasons:</p><ul><li>Internal record keeping. </li>
                              <li>We may use the information to improve our products and services.</li>
                              <li>We may periodically send promotional emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.</li>
                              <li>From time to time, we may also use your information to contact you for market research purposes. We may contact you by email, phone, fax or mail. We may use the information to customise the website according to your interests.</li></ul>
                              <h2>Security</h2>
                              <p>We are committed to ensuring that your information is secure. In order to prevent unauthorised access or disclosure, we have put in place suitable physical, electronic and managerial procedures to safeguard and secure the information we collect online.</p>
                              <h2>How we use cookies</h2>
                              <p>A cookie is a small file which asks permission to be placed on your computer&#39;s hard drive. Once you agree, the file is added and the cookie helps analyse web traffic or lets you know when you visit a particular site.
                              Cookies allow web applications to respond to you as an individual. The web application can tailor its operations to your needs, likes and dislikes by gathering and remembering information about your preferences.</p>
                              <p>We use traffic log cookies to identify which pages are being used. This helps us analyse data about webpage traffic and improve our website in order to tailor it to customer needs.
                              We only use this information for statistical analysis purposes and then the data is removed from the system.</p>
                              <p>Overall, cookies help us provide you with a better website by enabling us to monitor which pages you find useful and which you do not. A cookie in no way gives us access to your computer or any information about you, other than the data you choose to share with us.</p>
                              <p>You can choose to accept or decline cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer.
                              This may prevent you from taking full advantage of the website.</p>
                              <h2>Links to other websites</h2>
                              <p>Our website may contain links to other websites of interest. However, once you have used these links to leave our site, you should note that we do not have any control over that other website.
                              Therefore, we cannot be responsible for the protection and privacy of any information which you provide whilst visiting such sites and such sites are not governed by this privacy statement.
                              You should exercise caution and look at the privacy statement applicable to the website in question.</p>
                              <h2>Controlling your personal information</h2>
                              <p>You may choose to restrict the collection or use of your personal information in the following ways:</p>
                              <ul><li>whenever you are asked to fill in a form on the website, look for the box that you can click to indicate that you do not want the information to be used by anybody for direct marketing purposes</li>
                              <li>if you have previously agreed to us using your personal information for direct marketing purposes, you may change your mind at any time by writing to or emailing us</li></ul>
                              <p>We will not sell, distribute or lease your personal information to third parties unless we have your permission or are required by law to do so.
                              We may use your personal information to send you promotional information about third parties which we think you may find interesting if you tell us that you wish this to happen.</p>
                              <p>You may request details of personal information which we hold about you under the Data Protection Act 1998. A small fee will be payable. If you would like a copy of the information held on you please contact us.</p>
                              <p>If you believe that any information we are holding on you is incorrect or incomplete, please write to or email us as soon as possible at the above address. We will promptly correct any information found to be incorrect.</p>',
                'template' => 'defaultLayout',
                'child_template' => '',
                'on_main_nav' => 0,
                'slug' => 'privacy',
                'active' => 1,
            ],
        ]);
    }
}
