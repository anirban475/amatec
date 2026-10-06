# -*- coding: utf-8 -*-
"""
Single source of truth for the Amatec website copy and AIO edits.

Each edit: id, file (relative to the theme root), find, replace, why.
`find` must occur exactly once in the file (unless all=True).
Facts that need Anirban's sign-off carry a `fact` key (see FACTS in the brief).

Used by apply_edits.py (apply + verify) and build_brief.py (writes the brief).
"""

T = "\t"

EDITS = []


def e(id, file, find, replace, why, fact=None, all=False):
    EDITS.append(dict(id=id, file=file, find=find, replace=replace, why=why, fact=fact, all=all))


# ---------------------------------------------------------------- HOME
e("H01", "template-parts/home/hero.php",
  "ZOHO PARTNER · n8n · MAKE · MONDAY",
  "ZOHO PARTNER · n8n · MAKE · MONDAY",
  "Keep only if F5 Zoho partner = YES. If NO, replace with: ZOHO · n8n · MAKE · MONDAY",
  fact="F5")

e("H02", "template-parts/home/hero.php",
  "We connect your tools into workflows that run themselves, so your team stops copy-pasting\n" + T*4 + "between systems and starts shipping real work.",
  "Amatec builds automated workflows on Make.com, n8n, Zoho and monday.com. Your CRM, inbox,\n" + T*4 + "invoices and spreadsheets start passing data to each other, and nobody copies it by hand again.",
  "First sentence now names the company, the category and the four platforms. AI engines lift this line as the entity description.")

e("H03", "template-parts/home/hero.php",
  "Live in weeks, not months</span>",
  "Fixed-scope quote before we build</span>",
  "Removes a 'not X' contrast and a timing promise we cannot prove on every job.")

e("H04", "template-parts/home/how-it-works.php",
  "'meta' => 'Free workflow audit · ~45 min' ),",
  "'meta' => 'Free workflow audit · 30 min' ),",
  "The Cal.com event (amatec/meeting) is 30 minutes. The site said 45 in some places and 30 in others.")

e("H05", "template-parts/home/how-it-works.php",
  "'meta' => 'Live in weeks, not months' ),",
  "'meta' => 'Go-live date agreed in the quote' ),",
  "Same reason as H03.")

e("H06", "template-parts/home/results.php",
  "array( 'fig' => '40+',  'unit' => 'hrs / month',   'label' => 'saved per workflow, on average' ),\n"
  + T + "array( 'fig' => '3→1',  'unit' => 'systems',       'label' => 'disconnected tools, one workflow' ),\n"
  + T + "array( 'fig' => '2 wks','unit' => 'typical',       'label' => 'from audit to live automation' ),",
  "array( 'fig' => '2020', 'unit' => 'since',         'label' => 'building client automations' ),\n"
  + T + "array( 'fig' => '4',    'unit' => 'platforms',     'label' => 'Make.com, n8n, Zoho and monday.com' ),\n"
  + T + "array( 'fig' => '3',    'unit' => 'published apps','label' => 'two on the Zoho Marketplace, one on Make' ),",
  "Default swaps unsourced averages for facts anyone can check. If F4 = YES (Anirban has the data behind 40+ hrs and 2 wks), skip this edit.",
  fact="F4")

e("H07", "template-parts/home/results.php",
  "<h2 class=\"h2\">Fewer manual steps. Measurable hours back.</h2>",
  "<h2 class=\"h2\">The track record, in four numbers</h2>",
  "Matches the new stat set from H06. Skip if H06 is skipped.",
  fact="F4")

e("H08", "template-parts/home/results.php",
  "<p class=\"lead\">What an AMATEC automation typically returns to a team.</p>",
  "<p class=\"lead\">Every number here can be checked on a marketplace listing or a client reference.</p>",
  "Same as H07. Skip if H06 is skipped.",
  fact="F4")

e("H09", "template-parts/home/contact.php",
  "'45-minute call with an automation expert',",
  "'30-minute call with the engineer who would build it',",
  "Call length fix (F2) and a concrete promise about who is on the call.")

e("H10", "front-page.php",
  "get_template_part( 'template-parts/home/platforms' );",
  "get_template_part( 'template-parts/home/platforms' );\nget_template_part( 'template-parts/home/summary' );",
  "Inserts the new plain-English 'What Amatec does' block (new file N01). This is the paragraph AI answers quote when someone asks who Amatec is.")

e("H11", "front-page.php",
  "get_template_part( 'template-parts/home/contact' );",
  "get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_home_faqs() ) ) );\nget_template_part( 'template-parts/home/contact' );",
  "Adds a homepage FAQ (data in N04, function amatec_home_faqs). FAQs are the most-cited block type in AI answers.")

# ---------------------------------------------------------------- ABOUT
e("A01", "template-parts/about/hero.php",
  "Automation isn&rsquo;t a department here.<br>\n" + T*3 + "It&rsquo;s the <span class=\"accent\">whole company</span>.",
  "Automation is the <span class=\"accent\">only thing</span> we do.",
  "The old H1 is the 'it isn't X, it's Y' pattern, the second most common AI tell.")

e("A02", "template-parts/about/hero.php",
  "We&rsquo;re a Vadodara-based automation studio building no-code and low-code workflows for teams\n"
  + T*3 + "around the world. One focus, four platforms, nine years of doing nothing but this.",
  "We&rsquo;re an automation studio in Vadodara, India. Since 2020 we have built workflows on Make.com,\n"
  + T*3 + "n8n, Zoho and monday.com for teams in the US, Europe and Asia.",
  "Removes the rule-of-three line and the unproven 'nine years'. Uses the year the client testimonial confirms.",
  fact="F1")

e("A03", "template-parts/about/stats.php",
  "array( 'fig' => '9', 'unit' => 'years',      'label' => 'doing nothing but automation' ),",
  "array( 'fig' => '2020', 'unit' => 'since',   'label' => 'building client automations' ),",
  "Years claim made consistent across the site (F1).",
  fact="F1")

e("A04", "template-parts/about/stats.php",
  "'label' => 'certified: Make · n8n · Zoho · Monday' ),",
  "'label' => 'Make · n8n · Zoho · Monday' ),",
  "Default drops 'certified' from this label. If F5 is YES for all four platforms, skip this edit.",
  fact="F5")

e("A05", "template-parts/about/stats.php",
  "array( 'fig' => '1', 'unit' => 'public app', 'label' => 'Make.com app published (Aurora Solar)' ),",
  "array( 'fig' => '3', 'unit' => 'published apps', 'label' => 'Two on the Zoho Marketplace, one on Make' ),",
  "The two Zoho Marketplace extensions were missing from the About page entirely.",
  fact="F7")

e("A06", "template-parts/about/founder.php",
  "if software can do the work, a human shouldn't. Nine years and hundreds of workflows later, that\n"
  + T*6 + "conviction is the whole company.",
  "if software can do the work, a human shouldn't. He has built client workflows since 2020, and that\n"
  + T*6 + "conviction still decides which jobs we take.",
  "Removes the unproven 'nine years and hundreds of workflows'.",
  fact="F1")

e("A07", "template-parts/about/founder.php",
  "He builds in <strong>Make.com, n8n, Zoho and Monday.com</strong>, certified\n"
  + T*6 + "across all four, with a public app on the Make marketplace.",
  "He builds in <strong>Make.com, n8n, Zoho and Monday.com</strong>, has published two extensions\n"
  + T*6 + "on the Zoho Marketplace and an app on Make.",
  "Default drops 'certified across all four'. If F5 is YES for all four, keep the word 'certified' by writing: '...Monday.com</strong>, is certified on all four, and has published two extensions'.",
  fact="F5")

e("A08", "template-parts/about/founder.php",
  "its place: GPT-4o pipelines, Whisper transcription, Postgres-and-Slack coaching bots.",
  "its place: GPT-4o pipelines, Whisper transcription, Postgres-and-Slack coaching bots, and MCP\n"
  + T*6 + "servers that let ChatGPT and Claude read a company&rsquo;s Zoho data.",
  "Adds the MCP work, which is current and specific, and is what people now ask AI assistants about.",
  fact="F10")

e("A09", "template-parts/about/founder.php",
  "array( 'icon' => 'bot',         'text' => 'AI pipelines: GPT-4o · Whisper · Postgres' ),",
  "array( 'icon' => 'bot',         'text' => 'AI builds: GPT-4o · Whisper · MCP servers' ),",
  "Same as A08.",
  fact="F10")

e("A10", "template-parts/about/founder.php",
  "array( 'icon' => 'badge-check', 'text' => 'Certified: Make · n8n · Zoho · Monday' ),",
  "array( 'icon' => 'badge-check', 'text' => 'Builds on Make · n8n · Zoho · Monday' ),",
  "Default removes the certification claim. If F5 is YES for all four platforms, skip this edit.",
  fact="F5")

e("A11", "template-parts/about/values.php",
  "'body' => 'We sell time back and fewer errors, not seats, not buzzwords. If a workflow doesn’t remove real work, it doesn’t ship.' ),",
  "'body' => 'We judge a project by the hours it gives back and the errors it removes. If a workflow doesn’t remove real work, it doesn’t ship.' ),",
  "Removes the 'not X, not Y' pattern.")

e("A12", "template-parts/about/certs.php",
  "<p class=\"lead\">Certified across all four platforms we build on, with a public app on the Make marketplace to prove it.</p>",
  "<p class=\"lead\">Two extensions on the Zoho Marketplace and an app on Make. You can install them and judge the work yourself.</p>",
  "Default swaps the certification claim for proof a reader can check. If F5 is YES for all four, use: 'Certified on all four platforms we build on, with two Zoho Marketplace extensions and a Make app you can install today.'",
  fact="F5")

e("A13", "template-parts/about/certs.php",
  "$clients = array( 'Blink Energy Services · TX', 'Chaoshi Limited', 'Recurring EU clients' );",
  "$clients = array( 'Chaoshi Limited', 'Produits du Cap', 'Dr. Miami' );",
  "Default removes Blink Energy (that deal was lost in July 2026) and names two clients who already appear in testimonials on this site. If F6 = YES, keep Blink Energy.",
  fact="F6")

e("A14", "template-parts/about/certs.php",
  "<span class=\"kicker\">Trusted by teams worldwide</span>",
  "<span class=\"kicker\">Some of the teams we work with</span>",
  "Plainer and matches the shorter list.")

e("A15", "template-parts/about/cta.php",
  "'45-minute call with the builder, not a sales rep',",
  "'30-minute call with the person who will build it',",
  "Call length fix (F2). Drops the 'not X' contrast.")

e("A16", "template-parts/about/cta.php",
  "Forty-five minutes with the person who&rsquo;ll actually build it.",
  "Thirty minutes with the person who&rsquo;ll actually build it.",
  "Call length fix (F2).")

# ---------------------------------------------------------------- PLATFORM STATS (three files, same block)
for _id, _f in (("P01", "template-parts/platforms/monday-why.php"),
                 ("P02", "template-parts/platforms/n8n-control.php"),
                 ("P03", "template-parts/platforms/zoho-why.php")):
    e(_id, _f,
      "array( 'n' => '250+', 'l' => 'Workflows shipped' ),\n"
      + T + "array( 'n' => '120+', 'l' => 'Satisfied clients' ),\n"
      + T + "array( 'n' => '9 yrs', 'l' => 'Doing only automation' ),",
      "array( 'n' => '2020', 'l' => 'Building client automations since' ),\n"
      + T + "array( 'n' => '2', 'l' => 'Apps on the Zoho Marketplace' ),\n"
      + T + "array( 'n' => '4', 'l' => 'Platforms we build on' ),",
      "Default replaces unsourced counts with checkable facts. If F3 = YES (Anirban can back 250+ and 120+), keep those two and change only '9 yrs' to '2020' / 'Building client automations since'.",
      fact="F3")

# ---------------------------------------------------------------- MAKE
e("M01", "template-parts/platforms/make-services.php",
  "'d' => 'Connect 1,500+ apps (CRMs, sheets, email, payments, AI) into one reliable end-to-end flow.' ),",
  "'d' => 'Connect your CRM, sheets, email, payments and AI tools into one flow that runs on its own.' ),",
  "Make's app count changes often. A stale number is worse than none when an AI engine quotes it.")

e("M02", "template-parts/platforms/make-services.php",
  "Not just wired-together modules. These are scenarios designed to survive real volume, edge cases, and the next person who opens them.",
  "Scenarios built to survive real volume, odd edge cases, and the next person who has to open them.",
  "Removes 'Not just'.")

e("M03", "template-parts/platforms/make-why.php",
  "'d' => 'We build for teams across the US, EU, and Asia, in industries from eCommerce to healthcare.' ),",
  "'d' => 'Clients in the US, Europe and Asia, including a Miami medical practice and a food producer we have worked with since 2020.' ),",
  "Swaps a false range for two real, named examples.")

e("M04", "page-make-com-automation.php",
  "get_template_part( 'template-parts/landing/book', null, array( 'data' => array(",
  "get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'make' ) ) ) );\nget_template_part( 'template-parts/landing/book', null, array( 'data' => array(",
  "Adds a Make.com FAQ above the booking block (data in N04).")

# ---------------------------------------------------------------- n8n
e("N8_01", "template-parts/platforms/n8n-hero.php",
  "Enterprise-grade, open-source workflow automation for data-sensitive and IT-heavy teams. Orchestrate complex data flows across cloud and on-premise systems, with total control over where your data lives.",
  "n8n is a fair-code automation platform you can run on your own server. We set it up, build the workflows and keep them running, so sensitive data never passes through a third-party automation service.",
  "Definition first. Also fixes a factual error: n8n is fair-code (Sustainable Use License), not open source. AI engines repeat whatever we say here.")

e("N8_02", "template-parts/platforms/n8n-hero.php",
  "$badges = array( 'Self-hosted', 'Open-source', 'Secure by design' );",
  "$badges = array( 'Self-hosted', 'Fair-code', 'Your data stays on your servers' );",
  "Same licence fix.")

e("N8_03", "template-parts/platforms/n8n-control.php",
  "'d' => 'A preferred fit for data-sensitive industries with strict security and governance requirements.' ),",
  "'d' => 'When data must stay in your own cloud or office network, self-hosting is the simplest way to keep it there.' ),",
  "Concrete reason instead of a vague claim.")

e("N8_04", "template-parts/platforms/n8n-control.php",
  "'d' => 'Open-source and modular: extend with custom nodes and grow without per-task SaaS pricing.' ),",
  "'d' => 'Self-hosted n8n has no per-task pricing, and custom nodes let you extend it when the built-in ones run out.' ),",
  "Licence fix plus a plainer sentence.")

e("N8_05", "page-n8n-workflow-automation.php",
  "'sub'     => __( 'Thirty minutes with an automation engineer. We’ll map your data flows and show you exactly what to automate to reduce manual work, cut costs, and scale operations, securely.', 'amatec' ),",
  "'sub'     => __( 'Thirty minutes with the engineer who would build it. We’ll map your data flows and show you which ones are worth automating first.', 'amatec' ),",
  "Removes a rule-of-three line.")

e("N8_06", "page-n8n-workflow-automation.php",
  "get_template_part( 'template-parts/landing/book', null, array( 'data' => array(",
  "get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'n8n' ) ) ) );\nget_template_part( 'template-parts/landing/book', null, array( 'data' => array(",
  "Adds an n8n FAQ.")

# ---------------------------------------------------------------- MONDAY
e("MO01", "template-parts/platforms/monday-hero.php",
  "We automate the busywork inside your Work OS: recipes, integrations, and dashboards that keep teams aligned, cut manual data entry, and give managers a real-time view of every project.",
  "We set up monday.com boards, automation recipes and integrations so status updates, handoffs and reports happen on their own. Managers see where every project stands without asking.",
  "Drops the 'Work OS' jargon and the stacked benefit list.")

e("MO02", "template-parts/platforms/monday-services.php",
  "We turn monday.com boards into intelligent workflow engines, eliminating redundant tasks, improving visibility, and keeping every team aligned.",
  "Boards that update themselves and stay in sync with the tools your team already uses.",
  "Removes a rule-of-three line.")

e("MO03", "page-monday-com-workflow-automation.php",
  "get_template_part( 'template-parts/landing/book', null, array( 'data' => array(",
  "get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'monday' ) ) ) );\nget_template_part( 'template-parts/landing/book', null, array( 'data' => array(",
  "Adds a monday.com FAQ.")

# ---------------------------------------------------------------- ZOHO
e("Z01", "template-parts/platforms/zoho-hero.php",
  "<span class=\"accent\"><?php esc_html_e( 'certified partners', 'amatec' ); ?></span>",
  "<span class=\"accent\"><?php esc_html_e( 'certified partners', 'amatec' ); ?></span>",
  "Keep only if F5 Zoho = YES. If NO, change 'certified partners' to 'Zoho app developers' (we have two Marketplace apps).",
  fact="F5")

e("Z02", "template-parts/platforms/zoho-why.php",
  "array( 'icon' => 'shield-check', 't' => 'Secure, reliable, ROI-first', 'd' => 'Every workflow is documented, tested, and optimized to cut cost and improve efficiency.' ),",
  "array( 'icon' => 'shield-check', 't' => 'Tested on real records', 'd' => 'Every workflow is documented and tested on real records before it touches live data.' ),",
  "Specific promise instead of three adjectives.")

e("Z03", "page-zoho-workflow-automation.php",
  "get_template_part( 'template-parts/landing/book', null, array( 'data' => array(",
  "get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'zoho' ) ) ) );\nget_template_part( 'template-parts/landing/book', null, array( 'data' => array(",
  "Adds a Zoho FAQ.")

# ---------------------------------------------------------------- AI PAGE
e("AI01", "template-parts/ai/hero.php",
  "$badges = array( 'Machine learning', 'Natural language', 'Data analytics' );",
  "$badges = array( 'OpenAI GPT', 'Whisper speech-to-text', 'MCP servers' );",
  "Names the real tools we use instead of textbook categories.")

e("AI02", "template-parts/ai/hero.php",
  "We blend machine learning, natural language processing, and data analytics into automation that goes far beyond simple scripting, so your B2B team boosts productivity, cuts manual effort, and decides with intelligence.",
  "We add AI steps to the workflows you already run. A model reads the email, pulls the fields off the invoice or scores the lead, and the workflow carries on without a person in the middle. You can see every decision it made.",
  "The old line was the most machine-sounding sentence on the site.")

e("AI03", "template-parts/ai/services.php",
  "We automate the repetitive, judgment-heavy tasks that slow teams down, using machine learning, NLP, and analytics tuned to your data.",
  "Reading, sorting and scoring used to need a person. A model can now do the first pass, and your team checks the cases that matter.",
  "Plain language.")

e("AI04", "template-parts/ai/services.php",
  "array( 'icon' => 'users-round', 't' => 'Customer segmentation', 'd' => 'Group customers intelligently for sharper targeting, personalization, and engagement.' ),",
  "array( 'icon' => 'plug-zap', 't' => 'MCP servers for your data', 'd' => 'Let ChatGPT or Claude answer questions from your Zoho Books, Inventory or CRM data through an MCP server we build, read-only by default.' ),",
  "Swaps a generic card for real, current work that buyers are searching for.",
  fact="F10")

e("AI05", "template-parts/ai/services.php",
  "array( 'icon' => 'cloud', 'name' => 'Google Cloud AI' ),\n"
  + T + "array( 'icon' => 'brain-circuit', 'name' => 'Azure Cognitive Services' ),\n"
  + T + "array( 'icon' => 'settings-2', 'name' => 'Custom-trained models' ),",
  "array( 'icon' => 'audio-lines', 'name' => 'OpenAI Whisper' ),\n"
  + T + "array( 'icon' => 'brain-circuit', 'name' => 'Anthropic Claude' ),\n"
  + T + "array( 'icon' => 'workflow', 'name' => 'n8n AI agents' ),",
  "Lists only what we actually build with. If Anirban has shipped Google Cloud AI or Azure work, keep those.",
  fact="F11")

e("AI06", "template-parts/ai/approach.php",
  "'d' => 'We design and ship solutions tailored to your needs, from off-the-shelf models to custom-trained ones.' ),",
  "'d' => 'We pick the model and build the workflow around it, starting with the cheapest model that does the job well.' ),",
  "Specific stance instead of a false range.")

e("AI07", "template-parts/ai/approach.php",
  "'d' => 'CRM, ERP, support, or comms tools: our AI fits in seamlessly, no rip-and-replace.' ),",
  "'d' => 'It plugs into your CRM, helpdesk or inbox through the tools you already use.' ),",
  "Removes 'seamlessly' (banned word).")

e("AI08", "template-parts/ai/approach.php",
  "'d' => 'We practice responsible AI development by using clear governance frameworks for transparency, data protection, and compliance. Every solution is rigorously tested, monitored, and fine-tuned for accuracy.' ),",
  "'d' => 'Every AI step logs what it read and what it decided. We test it on your real data before go-live and keep a person in the loop wherever a wrong answer would cost money.' ),",
  "Concrete practice instead of governance buzzwords.")

e("AI09", "template-parts/ai/approach.php",
  "<?php esc_html_e( 'We integrate smoothly with your existing tech stack, and deploy responsibly.', 'amatec' ); ?>",
  "<?php esc_html_e( 'Three steps, and a person stays in control at each one.', 'amatec' ); ?>",
  "Plainer.")

e("AI10", "page-ai-powered-task-automation.php",
  "'sub'     => __( 'Thirty minutes with an automation engineer. We’ll pinpoint where AI can reduce manual work, cut costs, and scale your operations, intelligently.', 'amatec' ),",
  "'sub'     => __( 'Thirty minutes with the engineer who would build it. We’ll find the two or three tasks where AI would save your team the most time.', 'amatec' ),",
  "Removes rule of three.")

e("AI11", "page-ai-powered-task-automation.php",
  "get_template_part( 'template-parts/landing/book', null, array( 'data' => array(",
  "get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'ai' ) ) ) );\nget_template_part( 'template-parts/landing/book', null, array( 'data' => array(",
  "Adds an AI FAQ, including 'What is an MCP server?'.")

# ---------------------------------------------------------------- T-CHAT
e("TC01", "template-parts/products/tchat-overview.php",
  "T-Chat brings a WhatsApp-style chat interface and direct Twilio integration into Zoho CRM. Send, receive, and track SMS/MMS without leaving the platform. Sales and support teams communicate faster and smarter.",
  "T-Chat adds a chat window and a direct Twilio connection to Zoho CRM. Your team sends, receives and tracks SMS and MMS without leaving the record they are working on. On the Zoho Marketplace it is listed as Twilio Chat for Zoho CRM.",
  "'WhatsApp-style' has already led the live meta description to claim WhatsApp support, which the product does not describe. The last sentence ties the two product names together for search and AI.",
  fact="F9")

e("TC02", "template-parts/products/tchat-features.php",
  "array( 'icon' => 'message-circle', 't' => 'WhatsApp-style chat UI', 'd' => 'A familiar, intuitive chat experience that makes every customer conversation feel effortless.' ),",
  "array( 'icon' => 'message-circle', 't' => 'Familiar chat window', 'd' => 'Messages appear as a chat thread on the record, so nobody needs training to use it.' ),",
  "Same WhatsApp confusion fix.",
  fact="F9")

e("TC03", "template-parts/products/tchat-cta.php",
  "<?php esc_html_e( 'Install Twilio Chat Messenger today', 'amatec' ); ?>",
  "<?php esc_html_e( 'Install T-Chat for Zoho CRM', 'amatec' ); ?>",
  "The product had three names on one page. One name helps people and AI engines match it.")

e("TC04", "template-parts/products/tchat-cta.php",
  "Boost productivity and customer satisfaction with direct messaging inside Zoho CRM. Get started in minutes: no coding, no clutter, just clear communication.",
  "Text your leads from inside Zoho CRM using your own Twilio number. Setup takes a few minutes and needs no code.",
  "Removes a slogan triplet.")

e("TC05", "page-t-chat-zoho-extension.php",
  "get_template_part( 'template-parts/products/tchat-cta' );",
  "get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'tchat' ) ) ) );\nget_template_part( 'template-parts/products/tchat-cta' );",
  "Adds a T-Chat FAQ.")

# ---------------------------------------------------------------- STOCK PROCUREMENT
e("SP01", "template-parts/products/stock-hero.php",
  "<?php esc_html_e( 'product demo · drop AMATEC.mp4 here', 'amatec' ); ?>",
  "<?php esc_html_e( 'Demo video coming soon', 'amatec' ); ?>",
  "A developer placeholder is showing to visitors on the live page.")

e("SP02", "template-parts/products/stock-hero.php",
  "<a href=\"#sp-demo\" class=\"btn btn-outline-light\"><i data-lucide=\"play\"></i> <?php esc_html_e( 'Watch the demo', 'amatec' ); ?></a>",
  "<a href=\"#sp-features\" class=\"btn btn-outline-light\"><i data-lucide=\"arrow-down\"></i> <?php esc_html_e( 'See what it does', 'amatec' ); ?></a>",
  "The button promised a demo that does not exist yet. It now scrolls to the features section.")

e("SP03", "template-parts/products/stock-features.php",
  "array( 'icon' => 'plug', 't' => 'Seamless Zoho integration', 'd' => 'Lives natively inside Zoho Inventory using your existing items and bills of materials. Nothing to migrate.' ),",
  "array( 'icon' => 'plug', 't' => 'Runs inside Zoho Inventory', 'd' => 'Uses the items and bills of materials you already have. Nothing to migrate.' ),",
  "Removes 'Seamless' (banned word).")

e("SP04", "page-stock-procurement-for-zoho-inventory.php",
  "get_template_part( 'template-parts/products/stock-cta' );",
  "get_template_part( 'template-parts/landing/faq', null, array( 'data' => array( 'faqs' => amatec_platform_faqs( 'stock' ) ) ) );\nget_template_part( 'template-parts/products/stock-cta' );",
  "Adds a Stock Procurement FAQ.")

# ---------------------------------------------------------------- LANDING PAGES (inc/lp-pages.php): hero H1s
_heroes = [
    ("L01", "workflow-automation", "Unload your workload —", "your operations", "run themselves",
     "Hand the busywork to", "workflows", "that run themselves"),
    ("L02", "crm-automation", "A CRM that works for your team —", "not one", "your team has to feed",
     "A CRM that", "updates itself", "so your reps can sell"),
    ("L03", "it-company", "Scale delivery —", "without scaling", "admin",
     "Grow client delivery", "without growing", "the admin"),
    ("L04", "ecommerce", "Run operations —", "at any", "volume",
     "Orders, stock and shipping", "in sync", "at any volume"),
    ("L05", "startups", "Scale lean —", "grow", "fast",
     "Do the work of a bigger team", "without hiring", "one"),
    ("L06", "healthcare", "Spend more time —", "on", "patients",
     "Less admin,", "more time", "with patients"),
    ("L07", "real-estate", "Be first —", "to every", "lead",
     "Reply to every lead", "within seconds", ""),
    ("L08", "small-business", "Get hours back —", "every", "week",
     "Get", "hours back", "every week"),
    ("L09", "enterprise", "Connect your systems —", "scale your", "processes",
     "Make your CRM, ERP and finance systems", "work as one", ""),
    ("L10", "lead-sales-automation", "Stop —", "losing", "leads",
     "Answer every lead", "while it is still warm", ""),
    ("L11", "marketing-automation", "Put your marketing —", "on", "autopilot",
     "Campaigns and follow-ups that", "send themselves", ""),
    ("L12", "finance-accounting-automation", "Close your books —", "faster", "",
     "Invoices, payments and reconciliation", "without re-keying", ""),
    ("L13", "hr-operations-automation", "Run operations —", "on", "autopilot",
     "Onboarding, approvals and paperwork", "on autopilot", ""),
    ("L14", "customer-support-automation", "Resolve faster —", "scale", "smarter",
     "Route every ticket", "to the right person", "the moment it arrives"),
]
for _id, slug, ol, oa, ot, nl, na, nt in _heroes:
    I = T * 4
    e(_id, "inc/lp-pages.php",
      f"{I}'lead' => '{ol}',\n{I}'accent' => '{oa}',\n{I}'tail' => '{ot}',",
      f"{I}'lead' => '{nl}',\n{I}'accent' => '{na}',\n{I}'tail' => '{nt}',",
      f"Page /{slug}/ H1. Removes the em dash. Renders as: {nl} [{na}] {nt}".rstrip())

# ---------------------------------------------------------------- LANDING PAGES: claims and tells
e("L15", "inc/lp-pages.php",
  "'sub' => 'We are consulting-led, not just builders. We automate the highest-ROI processes first, on the right platform for your stack.',",
  "'sub' => 'We start with the processes that pay back fastest, then build them on the platform that suits your stack.',",
  "/workflow-automation/. Removes 'not just'.")

e("L16", "inc/lp-pages.php",
  "'title' => 'Automation partners, not just builders',",
  "'title' => 'We stay after go-live',",
  "/workflow-automation/. Removes 'not just'.")

e("L17", "inc/lp-pages.php",
  "'title' => 'Technical fluency, not just no-code',",
  "'title' => 'We write code when no-code runs out',",
  "/it-company/. Removes 'not just'.")

e("L18", "inc/lp-pages.php",
  "'title' => 'Integration expertise, not just no-code',",
  "'title' => 'Built for systems without clean APIs',",
  "/enterprise/. Removes 'not just'.")

for _id, old in (("L19", "5+ years in the field"), ("L20", "5+ years building"),
                 ("L21", "5+ years with small teams"), ("L22", "5+ years with small business"),
                 ("L23", "5+ years in sales ops")):
    e(_id, "inc/lp-pages.php", f"'t' => '{old}',", "'t' => 'Building automations since 2020',",
      "The site said 5+ years here and 9 years elsewhere. One consistent, checkable year.", fact="F1")

e("L24", "inc/lp-pages.php",
  "\t\t\t'quote' => array(\n\t\t\t\t'text' => 'AMATEC automated our entire onboarding flow, saving hours and boosting accuracy across departments.',\n\t\t\t\t'name' => 'Operations lead',\n\t\t\t\t'role' => 'Multi-department onboarding rollout',\n\t\t\t),\n",
  "",
  "/hr-operations-automation/. Deletes an anonymous quote with no name or company. It reads as invented and hurts trust. The template already handles a page with no quote.")

e("L25", "inc/lp-pages.php",
  "'t' => 'Protects the experience',\n\t\t\t\t\t\t'd' => 'Designed to enhance, not replace.',",
  "'t' => 'Humans keep the hard cases',\n\t\t\t\t\t\t'd' => 'Automation takes the routine tickets so agents handle the ones that need judgment.',",
  "/customer-support-automation/. Removes 'enhance, not replace'.")

e("L26", "inc/lp-pages.php",
  "We design workflows to enhance, not replace, the experience.",
  "Agents still handle anything that needs judgment.",
  "/customer-support-automation/ FAQ. Same fix.")

# Capitalisation bug after "Yes." / "No." / "Instantly." in FAQ answers (all occurrences).
e("L27", "inc/lp-pages.php", "'a' => 'Yes. we ", "'a' => 'Yes. We ", "Fixes 14 FAQ answers that start a sentence in lower case.", all=True)
e("L28", "inc/lp-pages.php", "'a' => 'No. that is", "'a' => 'No. That is", "Same capitalisation fix.")
e("L29", "inc/lp-pages.php", "'a' => 'No. done well,", "'a' => 'No. Done well,", "Same capitalisation fix.")
e("L30", "inc/lp-pages.php", "'a' => 'Instantly. automated", "'a' => 'Instantly. Automated", "Same capitalisation fix.")

# ---------------------------------------------------------------- BLOG CHROME + AUTHOR/DATE
e("B01", "single.php",
  "<?php esc_html_e( 'Pick a time that works for you and talk to an automation expert — or fill the form below and we’ll call you back.', 'amatec' ); ?>",
  "<?php esc_html_e( 'Pick a time to talk to an automation engineer, or fill in the form below and we’ll call you back.', 'amatec' ); ?>",
  "Removes an em dash.")

e("B02", "single.php",
  "<?php esc_html_e( '“Don’t work harder — automate smarter. Innovation begins where repetition ends.”', 'amatec' ); ?>",
  "<?php esc_html_e( 'If someone on your team does the same task every day, a workflow can probably do it for them.', 'amatec' ); ?>",
  "Replaces a slogan with an em dash and a 'not X, Y' line.")

e("B03", "single.php",
  "<span class=\"post-date\"><i data-lucide=\"calendar\"></i> <?php echo esc_html( get_the_date() ); ?></span>",
  "<span class=\"post-date\"><i data-lucide=\"calendar\"></i> <?php echo esc_html( get_the_date() ); ?></span>\n"
  + T*5 + "<?php if ( get_the_modified_date( 'Y-m-d' ) !== get_the_date( 'Y-m-d' ) ) : ?>\n"
  + T*5 + "<span class=\"post-date\"><i data-lucide=\"refresh-cw\"></i> <?php echo esc_html( sprintf( __( 'Updated %s', 'amatec' ), get_the_modified_date() ) ); ?></span>\n"
  + T*5 + "<?php endif; ?>\n"
  + T*5 + "<span class=\"post-date\"><i data-lucide=\"user-round\"></i> <?php echo esc_html( get_the_author() ); ?></span>",
  "Adds an author byline and a visible 'Updated' date to every post. AI engines favour content with a named author and a recent date.")

e("B04", "template-parts/blog/list.php",
  "'Practical playbooks on workflow automation — n8n, Make, Monday and Zoho — to help your team stop doing what software should do for them.'",
  "'Practical guides to workflow automation on n8n, Make, Monday and Zoho, written by the people who build it.'",
  "Removes two em dashes.")

e("B05", "template-parts/blog/list.php",
  "'New automation guides are on the way — check back soon.'",
  "'New automation guides are on the way. Check back soon.'",
  "Removes an em dash.")

e("B06", "template-parts/blog/consultation.php",
  "We’ll map your process and show you what’s worth automating — no obligation.",
  "We’ll map your process and show you what’s worth automating. No obligation.",
  "Removes an em dash.")

# ---------------------------------------------------------------- NAV
e("NAV01", "functions.php",
  T*2 + "array( 'label' => 'Case Studies', 'href' => '#case-studies' ),\n",
  "",
  "The Case Studies menu item points to #case-studies, which does not exist on any page. Default removes it. If F12 gives a real URL, set 'href' to that URL instead of deleting the line.",
  fact="F12")

# ---------------------------------------------------------------- SCHEMA + llms.txt hooks
e("S01", "template-parts/landing/faq.php",
  T*2 + "</div>\n" + T + "</div>\n</section>",
  T*2 + "</div>\n" + T + "</div>\n"
  + T + "<?php\n"
  + T + "$amatec_faq_ld = array(\n"
  + T*2 + "'@context'   => 'https://schema.org',\n"
  + T*2 + "'@type'      => 'FAQPage',\n"
  + T*2 + "'mainEntity' => array_map(\n"
  + T*3 + "function ( $f ) {\n"
  + T*4 + "return array(\n"
  + T*5 + "'@type'          => 'Question',\n"
  + T*5 + "'name'           => $f['q'],\n"
  + T*5 + "'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ),\n"
  + T*4 + ");\n"
  + T*3 + "},\n"
  + T*3 + "$data['faqs']\n"
  + T*2 + "),\n"
  + T + ");\n"
  + T + "?>\n"
  + T + "<script type=\"application/ld+json\"><?php echo wp_json_encode( $amatec_faq_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>\n"
  + "</section>",
  "Every FAQ block now also prints FAQPage structured data built from the same questions, so the visible text and the schema can never drift apart.")

e("S02", "functions.php",
  "require_once get_theme_file_path( 'inc/legal-pages.php' );",
  "require_once get_theme_file_path( 'inc/legal-pages.php' );\nrequire_once get_theme_file_path( 'inc/aio.php' );",
  "Loads the new inc/aio.php (N03): Organization schema, llms.txt route, and FAQ data.")

e("S03", "functions.php",
  "define( 'AMATEC_VERSION', '1.7.0' );",
  "define( 'AMATEC_VERSION', '1.8.0' );",
  "Version bump so browsers and LiteSpeed fetch fresh CSS and JS. The page-creation routine it also triggers only creates pages that are missing, so it is safe.")
