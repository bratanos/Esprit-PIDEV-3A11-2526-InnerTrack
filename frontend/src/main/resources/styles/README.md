# InnerTrack CSS Architecture

This directory follows a strict CSS architecture to ensure scalability, ease of development, and zero CSS collisions.

## Directory Structure

- `base/`: Global styles, reset rules (`root.css`), design tokens (`tokens.css`), typography (`typography.css`), and reusable global controls (`controls.css`). No view-specific styles should go here.
- `themes/`: Theme definitions (e.g., `theme-light.css`, `theme-dark.css`). They map variables from `tokens.css`.
- `components/`: Isolated component styles like `sidebar.css` or `header.css`. All classes here must be scoped to the component (e.g., `.sidebar`).
- `views/`: View-specific stylesheets (e.g., `auth.css`, `dashboard.css`). **MANDATORY**: All rules in view stylesheets must be namespaced using the view's root class (e.g., `.dashboard-view .my-custom-btn`).

## Rules for Teammates

1. **Tokens First:** Never hardcode colors or sizes. Always use variables defined in `tokens.css` (e.g., `-it-primary`).
2. **Namespace Your Views:** When writing CSS for your specific screen, it must be namespaced. E.g., `.settings-view .section-title { ... }`.
3. **No global element redefinition outside `controls.css`:** Do NOT redefine `.button`, `.card`, or `.text-field` in a view stylesheet. If you need a custom button, create a namespaced class like `.auth-view .login-button`.
4. **No `!important`:** The architecture guarantees specificity due to namespacing. Avoid `!important` at all costs.
5. **Single `.root` source:** The only place where `.root` is modified for base variables is in `base/tokens.css` and themes. Do not add `.root` selectors in view or component files.

## Adding New Styles Safely

1. Is it a generic button or text field change? Update `base/controls.css`.
2. Is it a color or spacing value used everywhere? Update `base/tokens.css`.
3. Is it a reusable UI block (like a card or modal)? Add it to `base/controls.css` or create a component in `components/`.
4. Is it a visual tweak just for your screen? Add it to `views/your-view.css` and make sure it's namespaced!
