# WooBlocks

A standalone WordPress block theme for an editorial fashion storefront, branded WooBlocks throughout.

## Requirements

- WordPress 6.7 or later and PHP 7.4 or later.
- A current WooCommerce installation for commerce. WooCommerce is not bundled or installed automatically.
- Products, categories, shipping, taxes, and payment gateways configured in WooCommerce.

The theme can be edited without WooCommerce. Commerce is unavailable until that dependency is installed. SureCart is not a replacement for this theme's WooCommerce integration.

## Setup

1. When ready, activate WooBlocks under Appearance > Themes. Creating this theme does not activate it or alter other themes or applications.
2. Install/configure WooCommerce separately. Use its setup tools to create and assign Shop, Cart, Checkout, and My account pages. Keep the Cart and Checkout blocks supplied by WooCommerce in their respective page content.
3. Assign the **Commerce page** template to Cart and Checkout for a wide layout. This works with custom page slugs and translated page names. The template renders existing page content; it does not create a second cart or checkout. It also preserves checkout endpoints, including order payment and order received.
4. Keep the My account page's WooCommerce content and assign Commerce page, or assign **Customer account** to render WooCommerce's account shortcode from the template. Do not insert an additional account shortcode when using Customer account. WooCommerce handles sign-in, registration settings, orders, addresses, and account endpoints.
5. Open Appearance > Editor > Templates > Front Page. This template takes precedence over static front-page content; edit it in the Site Editor. The blog continues to use the index template when assigned a separate posts page.
6. Edit the header and footer template parts. Set the logo, customize the WooBlocks wordmarks if desired, and save the Navigation block. Its starter Shop submenu includes up to six populated top-level product categories available when the pattern is first resolved. Saved menus are editor-owned snapshots, not continuously synchronized category lists.
7. Replace the footer Page List with selected Navigation links before launch if not every published page belongs in the footer. Add real policy and contact pages; the theme does not invent them.

No pages, products, settings, menu records, coupons, or users are created by this theme. There are no activation migrations or external network requests in theme code.

## Photography And Fonts

Editorial photography is not bundled. Hero, department, and story sections use editable Cover blocks with reserved space and no image URLs. They are intentionally unassigned. Select your licensed images in the editor, choose focal points, and check text contrast. Use informative alt text where the image adds content; decorative background photography can use empty alt text.

The source fonts are Anton, Archivo, and Pinyon Script. Their files are not bundled. The theme declares matching font stacks with local fallbacks and makes no Google Fonts requests. To match the reference, add appropriately licensed font files through Styles > Typography > Font Library and assign them to headings, body text, and script accents. Uploading fonts is a separate site-editing action.

## Editable Storefront

The WooBlocks pattern category contains the hero, departments, new arrivals, editorial story, seasonal promotion, and shopping FAQ. Product collections use real catalog data; the new-arrivals collection orders by publication date. Department links use existing `men`, `women`, and `kids` categories when present, otherwise the configured Shop URL. Review these links after category changes. Links resolve to the homepage before a Shop page is configured.

Catalog templates cover the shop, product categories, product tags, and product search, with inherited queries, sorting, counts, and pagination. Add WooCommerce's compatible product filter blocks in the Site Editor if needed; the source's bespoke filter interface is not ported. Product detail intentionally embeds WooCommerce's native product template through its Legacy Template block, preserving variations, stock rules, reviews, gallery behavior, and extension hooks rather than reimplementing them. The product body is consequently not composed of individually editable product blocks.

The header uses core Navigation with mobile overlay and an accessible submenu, core product search, and WooCommerce Mini-Cart with its native drawer. This is not the source's custom mega menu or search overlay. WooCommerce owns cart state and all price, shipping, tax, checkout, order confirmation, and gateway behavior. Order confirmation uses WooCommerce's supplied templates/endpoints; the theme never performs an independent order lookup or marks an order paid.

The source's newsletter, wishlist, quick view, recently viewed products, and animated lookbook are omitted. Fake subscriptions, fabricated reviews, unconfigured free-shipping claims, and automatic percentage-discount claims are not included. Editorial promotions do not create discount rules.

## Validation And Launch Checks

### Automated Checks

Development tools require Composer 2, PHP 7.4 or later, and Node 24.15 or later (or a supported Node version listed in package.json). From the theme repository:

```sh
composer install
npm ci
composer lint
npm run lint
```

Commit both lockfiles whenever dependencies change. CI uses `composer install` and `npm ci` to install locked dependencies. `composer lint:fix`, `npm run lint:css -- --fix`, and `npm run lint:js -- --fix` apply mechanical corrections; review their diffs before committing.

PHP_CodeSniffer runs the full WordPress standard over theme PHP. JavaScript and CSS use `@wordpress/scripts`; JavaScript checks include development scripts and automatically discover future theme source. An explicit message reports when no theme JavaScript exists. CSS permits WordPress/WooCommerce-owned class names without exempting theme classes. JSON validation downloads the WordPress 6.7 schema and fails on download, parsing, or validation errors.

The Theme Checks workflow runs on every pull request and push, and can be run manually. It checks PHP syntax on 7.4 and 8.3, standards on PHP 8.3, and Theme Check 20260901 on WordPress 6.7 and the stable release resolved at runtime (`latest`). Theme Check runs against a source-only theme copy in a disposable installation with no WooCommerce dependency; it does not use or change the Local site. Its native exit status gates CI, with advisory output retained in job logs. Tooling and dependency directories are not part of the checked runtime theme.

To run the same Theme Check manually in a separate disposable WordPress installation with the theme present:

```sh
wp plugin install theme-check --version=20260901 --activate
wp theme-check run wooblocks
```

After connecting this repository to GitHub and obtaining the first workflow result, protect the default and release branches using a ruleset or branch protection: require pull requests, require the **Automated Checks** status, require branches to be up to date, and prohibit bypasses. The aggregate status fails if any constituent job fails, is cancelled, or is skipped. Protect release tags separately and make any future release/deployment workflow depend on successful checks for the exact commit. This repository currently has no release workflow; adding CI alone does not enforce merging or publication.

Automated checks are not functional tests or proof of full cross-version compatibility. They do not replace the launch checks below.

Offline validation can check PHP syntax, theme JSON, block comment structure, pattern references, dependency guards, safe URLs, and native template composition. This does not prove Gutenberg save/serialize validity or successful shopping behavior.

With WooCommerce installed, verify the following before launch:

- Open every template and pattern in the Site Editor; save and reload without invalid-block recovery prompts.
- Check real images, fonts, text contrast, and layout at mobile and desktop sizes.
- Navigate by keyboard through the mobile menu, submenu, search, cart drawer, and checkout. Check focus return and Escape behavior; verify the core skip link.
- Exercise simple and variable products, unavailable variations, cart quantity changes, removals, coupons, and empty-cart states.
- Check search, category pagination and sorting, tax display, shipping zones, and account endpoints.
- Place guest and signed-in test orders through configured sandbox gateways; check failed/cancelled payments, order received, and customer order access.
- Recheck gateway-specific controls and extension styles on the dark storefront. Payment-gateway compatibility is supplied by the gateway, not the theme.

This workspace has no WooCommerce installation. No browser testing, activation, plugin installation, store setup, or database changes are performed as part of creating the theme.
