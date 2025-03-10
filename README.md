# Contao WhatsApp Button Bundle

A lightweight and versatile Contao bundle that adds a customizable WhatsApp button to your pages. Ideal for businesses, bloggers, or anyone looking to enable fast, direct communication with visitors via WhatsApp. Configure the button effortlessly through Contao’s backend with your phone number, default message, and styling—no coding skills needed!

## Features
- Seamless Integration: Easily add the WhatsApp button to any Contao page or module.
- Customizable: Set button text, phone number, and default message via page or module settings.
- Multi-Language Support: Fully translated into English, Persian (Farsi), and German for backend labels and descriptions.
- Device-Aware Links: Automatically adapts WhatsApp links for mobile (whatsapp://) and desktop (web.whatsapp.com) using JavaScript.
- Twig-Powered: Modern, secure templating with Contao 5.3’s Twig engine.
- Flexible Styling: Apply custom CSS classes through Contao’s backend for tailored designs.


## Installation
- Install via Composer: `composer require respinar/contao-whatsapp`
- Configure in the Contao backend under module and page settings.

## Configuration
1.  Module Settings: In the Contao backend, go to "Modules" > "Frontend Modules" > "New", select "Whatsapp" from the "Miscellaneous" category, and configure:
    - WhatsApp Title
    - WhatsApp Number (e.g., +1234567890)
    - Default Message
2. Page Settings: Optionally override module settings per page under "Site Structure" > "Page Properties" > "WhatsApp Settings".
3. Add the module to a page layout or article as needed.

## Usage
- The button appears wherever you include the module in your layout or content.
- Clicking it opens WhatsApp with the configured phone number and message, optimized for the user’s device (mobile app or web interface).
- Customize the appearance using CSS classes in the module settings.

## Requirements
- Contao 5.3 or higher
- PHP 8.2+

## License
MIT
Contributions and feedback welcome!
