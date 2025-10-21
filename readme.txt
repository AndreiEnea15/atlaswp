=== AtlasIS ===
Contributors: AndreiEnea15
Tags: search, index, filter, ajax, smart
Requires at least: 6.0
Tested up to: 6.8
Stable tag: 1.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


A lightweight, intelligent article index and search plugin with AI-style features like fuzzy matching, synonyms, and taxonomy relevance.

== Description ==
AtlasIS transforms your WordPress site into a smart content explorer.  
It provides AI-style search, fuzzy matching, synonym expansion, and taxonomy prioritization, making it easy for visitors to find relevant content.

**Features:**
- 🔍 **Hybrid Smart Search:** Combines synonyms, fuzzy, and partial match logic.
- 🧩 **Category & Tag Filters:** Let users narrow results by taxonomy.
- ⚡ **Instant AJAX Results:** See matches without reloading the page.
- 🧠 **Synonym Expansion:** Detects related terms for broader search accuracy.
- 🏷️ **Taxonomy Boost:** Prioritizes posts in relevant categories or tags.
- 💡 **Local Processing:** Runs entirely on your WordPress server — no external API needed.

**Use case examples:**
- News or blog websites that want a live content explorer.
- Knowledge bases or documentation hubs.
- Portfolios and case study indexes.

== Installation ==
1. Upload the `atlasis` folder to `/wp-content/plugins/`
2. Activate **AtlasIS** via the WordPress Plugins menu.
3. Add the shortcode `[atlasis_index]` to any page or post.

== Usage ==
Place the shortcode on a page (e.g., “Articles” or “Knowledge Base”).  
AtlasIS will automatically:
- Generate a searchable, filterable list of your posts.
- Include category and tag filters.
- Rank results by hybrid AI-style scoring.

== Frequently Asked Questions ==
= Does AtlasIS rely on external AI or cloud APIs? =
No. Everything runs locally in PHP and JavaScript — private, secure, and free.

= Can I customize the synonym list? =
Yes. Open `includes/smart-search-engine.php` and edit the synonym mappings.

= Can AtlasIS handle custom post types? =
Yes. You can extend it by adding filters for your custom post types.

== Changelog ==
= 1.1.0 =
* Added hybrid smart search (synonyms, partial, fuzzy, taxonomy boost)
* Added dynamic category and tag filters for article indexing
* Improved indexing and AJAX performance

== Upgrade Notice ==
= 1.1.0 =
Major update: AtlasIS now includes a full content index system with smart filtering.
