# feature-documentation-page

Allow Admins & Developers to add a richtext documentation page for all authors and editors.

---

Version: 1.1.0

Author: Matze @ https://modularity.group

License: MIT

---

Add an options page `Modules > Documentation Page` with a WYSIWYG-Editor field for users with `manage_options` capability.

Shows an admin page `Dashboard > Documentation` for all users with `edit_pages`.

---

1.1.0 
- wp_kses_post() for content-field sanitization instead if wp_filter_post_kses()

1.0.1
- fix content sanitization

1.0.0
- initial release
