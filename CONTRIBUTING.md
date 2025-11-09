# Contributing to SiteOrigin Snapshot

## Local Tooling

- Run `npm install` after cloning to pull dev dependencies (including `lefthook`). Git hooks rely on the binary that ships with `node_modules`, so installing once per checkout is required.
- Pre-commit and pre-push checks reuse scripts from the private `siteorigin-pre-commit` repository. Set `SITEORIGIN_PRE_COMMIT_PATH` to the absolute path of your clone so the hooks can find the shared scripts regardless of local layout.
- Pattern linting proxies to `siteorigin-pattern-system/tools/lint-pattern`. Provide its location via `SITEORIGIN_PATTERN_LINTER_PATH` if it isn’t available on your default path.

## REM vs Pixel Usage Guidelines

### Use REMs for:

- **Form elements and interactive components**
  - Input padding, button dimensions, form field spacing
  - *Reason: Should scale with user's font size for accessibility*

- **Typography-related spacing that should scale**
  - Line spacing within text blocks
  - Letter spacing (when relative scaling is desired)
  - *Reason: Maintains typographic rhythm across different font sizes*

- **Component spacing that needs to scale with content**
  - Internal spacing within complex UI components
  - Spacing between closely related text elements
  - *Reason: Maintains proportional relationships*

### Use Pixels for:

- **User-facing spacing settings in FSE**
  - Spacing presets (margins, padding options)
  - Block margins and padding
  - *Reason: Users understand "24px" better than "1.5rem"*

- **Layout and grid spacing**
  - Container widths, content areas
  - Grid gaps, column spacing
  - *Reason: Predictable, consistent layout structure*

- **Font sizes**
  - All font size presets
  - *Reason: Theme already uses pixel-based font system*

- **Borders and decorative elements**
  - Border widths, border radius
  - Shadows, outlines
  - *Reason: Visual consistency regardless of font size*

- **Fixed design elements**
  - Icon sizes, avatar dimensions
  - Fixed-height components
  - *Reason: Maintain visual hierarchy and design intent*

### Decision Matrix:

- **Is this user-facing in the FSE?** → Pixels (better UX)
- **Should this scale with font size for accessibility?** → REMs
- **Is this a layout/structural element?** → Pixels (predictable)
- **Is this typography-related spacing?** → Consider REMs
- **Does the user need to understand the exact size?** → Pixels

### Notes:

- Document the reasoning when choosing REMs in comments
- Always consider accessibility implications
- Test with different browser font sizes when using REMs
- Ensure consistency within similar component types 

---

## WordPress Full-Site Editing (FSE) Guidelines

### theme.json Best Practices

- **Always use theme.json for styling** instead of CSS when possible
- **Maintain semantic color names** (Primary, Secondary, Accent) rather than descriptive names
- **Use consistent spacing scales** - Our theme uses 8px increments (8px to 80px)
- **Test with style variations** - Ensure compatibility with dark.json and light.json
- **Follow version 3 schema** - Always use the latest theme.json version

### Template Development

- **Use patterns over direct HTML** in templates when possible
- **Template parts should be modular** and reusable across different templates
- **Follow WordPress template hierarchy** - Use proper naming conventions
- **Include proper pattern headers** - Hidden patterns need correct metadata
- **Test template inheritance** - Ensure fallback templates work correctly

### Block Customization

- **Extend blocks through variations** rather than creating new blocks
- **Use render_block filters** for PHP-based modifications
- **Follow WordPress coding standards** for all PHP modifications
- **Test block functionality** in both editor and frontend contexts
- **Document custom block styles** in theme.json

### Pattern Development

- **Create reusable patterns** for common content structures
- **Use semantic HTML** in all pattern content
- **Include accessibility attributes** (aria-labels, proper heading hierarchy)
- **Test patterns in different contexts** - Various post types and templates
- **Keep patterns focused** - One clear purpose per pattern

### Performance Guidelines

- **Minimize custom CSS** - Leverage theme.json styling system
- **Use local font files** - Store in assets/fonts/ directory
- **Optimize asset loading** - Use wp_get_theme()->get('Version') for cache busting
- **Test with caching plugins** - Ensure compatibility
- **Validate HTML output** - Use semantic, valid markup

### Testing Requirements

Before committing changes, ensure:

- **Style variations work** - Test with dark.json and light.json
- **Responsive design functions** across all viewport sizes
- **Block editor compatibility** - All blocks work in editor and frontend
- **Accessibility compliance** - Screen reader and keyboard navigation
- **Cross-browser testing** - Modern browser compatibility
- **PHP compatibility** - Test with minimum PHP 7.4

### Code Organization

- **PHP modifications** go in `/inc/blocks/` directory
- **JavaScript enhancements** go in `/js/` directory  
- **Template parts** go in `/parts/` directory
- **Block patterns** go in `/patterns/` directory
- **Style variations** go in `/styles/` directory
- **Custom templates** go in `/templates/` directory

### Documentation Standards

- **Add proper file headers** to all PHP and JS files
- **Use @since 1.0** for version documentation
- **Include @package siteorigin-snapshot** in headers
- **Comment complex logic** - Explain the "why" not just the "what"
- **Update contributing.md** when adding new conventions
