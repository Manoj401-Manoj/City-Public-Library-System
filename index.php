<?php
// Library Sections Map — Single PHP File
// All HTML, CSS, and JavaScript embedded below.

$page = isset($_GET['page']) ? htmlspecialchars($_GET['page']) : 'home';
$valid_pages = ['home', 'map', 'sections', 'events', 'contact'];
if (!in_array($page, $valid_pages)) $page = 'home';

// Contact form handler
$form_sent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    $form_sent = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>City Public Library</title>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --primary: #1a6fb5;
  --primary-dark: #145a95;
  --primary-light: #dbeafe;
  --accent: #f59e0b;
  --accent-light: #fef3c7;
  --bg: #f8f7f4;
  --card: #ffffff;
  --border: #e5e0d8;
  --text: #1e2a3a;
  --muted: #6b7a8d;
  --green: #16a34a;
  --green-light: #dcfce7;
  --purple: #7c3aed;
  --purple-light: #ede9fe;
  --pink: #db2777;
  --pink-light: #fce7f3;
  --red: #dc2626;
  --red-light: #fee2e2;
  --radius: 12px;
  --shadow: 0 2px 12px rgba(0,0,0,0.08);
  --shadow-lg: 0 8px 32px rgba(0,0,0,0.13);
}
body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; flex-direction: column; }
a { text-decoration: none; color: inherit; }
button, .btn { cursor: pointer; border: none; background: none; font-family: inherit; }

/* ── TOP BAR ── */
.topbar { background: var(--primary); color: #fff; font-size: 12px; padding: 6px 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 4px; }
.topbar span { display: flex; align-items: center; gap: 6px; }

/* ── NAVBAR ── */
.navbar { position: sticky; top: 0; z-index: 100; background: rgba(255,255,255,0.97); backdrop-filter: blur(8px); border-bottom: 1px solid var(--border); box-shadow: 0 1px 8px rgba(0,0,0,0.06); }
.navbar-inner { max-width: 1200px; margin: auto; padding: 0 24px; display: flex; align-items: center; justify-content: space-between; height: 62px; }
.logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
.logo-icon { width: 38px; height: 38px; background: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; flex-shrink: 0; }
.logo-text { line-height: 1.2; }
.logo-title { font-weight: 700; font-size: 14px; color: var(--text); }
.logo-sub { font-size: 11px; color: var(--muted); }
.nav-links { display: flex; align-items: center; gap: 4px; }
.nav-link { display: flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 8px; font-size: 14px; font-weight: 500; color: var(--muted); transition: all .18s; text-decoration: none; }
.nav-link:hover { background: #f0f4fa; color: var(--text); }
.nav-link.active { background: var(--primary); color: #fff; }
.nav-icon { font-size: 14px; }
.hamburger { display: none; flex-direction: column; gap: 5px; padding: 8px; cursor: pointer; border-radius: 8px; }
.hamburger span { display: block; width: 22px; height: 2px; background: var(--muted); border-radius: 2px; transition: all .2s; }
.mobile-menu { display: none; border-top: 1px solid var(--border); background: var(--card); padding: 10px 16px; }
.mobile-menu.open { display: block; }
.mobile-menu .nav-link { display: flex; width: 100%; margin-bottom: 4px; }

/* ── MAIN ── */
main { flex: 1; }
.container { max-width: 1200px; margin: auto; padding: 0 24px; }
.page-header { padding: 32px 0 20px; }
.page-header h1 { font-size: 26px; font-weight: 800; color: var(--text); }
.page-header p { color: var(--muted); margin-top: 4px; font-size: 15px; }

/* ── HERO ── */
.hero { background: linear-gradient(135deg, rgba(26,111,181,0.08) 0%, transparent 60%, rgba(245,158,11,0.06) 100%); border-bottom: 1px solid var(--border); padding: 60px 0 50px; position: relative; overflow: hidden; }
.hero::before { content: ''; position: absolute; top: -80px; left: 20%; width: 400px; height: 400px; border-radius: 50%; background: rgba(26,111,181,0.07); pointer-events: none; }
.hero-inner { max-width: 1200px; margin: auto; padding: 0 24px; }
.hero-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(26,111,181,0.1); border: 1px solid rgba(26,111,181,0.2); color: var(--primary); font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 20px; margin-bottom: 18px; }
.hero h1 { font-size: clamp(28px,5vw,48px); font-weight: 900; line-height: 1.15; color: var(--text); margin-bottom: 16px; max-width: 680px; }
.hero h1 span { color: var(--primary); }
.hero p { font-size: 17px; color: var(--muted); max-width: 520px; line-height: 1.7; margin-bottom: 28px; }
.hero-btns { display: flex; gap: 12px; flex-wrap: wrap; }
.btn-primary { display: inline-flex; align-items: center; gap: 8px; background: var(--primary); color: #fff; padding: 11px 22px; border-radius: 10px; font-size: 14px; font-weight: 600; box-shadow: 0 4px 14px rgba(26,111,181,0.3); transition: all .2s; text-decoration: none; border: none; cursor: pointer; }
.btn-primary:hover { background: var(--primary-dark); box-shadow: 0 6px 20px rgba(26,111,181,0.4); transform: translateY(-1px); }
.btn-secondary { display: inline-flex; align-items: center; gap: 8px; background: var(--card); color: var(--text); padding: 11px 22px; border-radius: 10px; font-size: 14px; font-weight: 600; border: 1.5px solid var(--border); transition: all .2s; text-decoration: none; cursor: pointer; }
.btn-secondary:hover { background: #f0f4fa; border-color: var(--primary); transform: translateY(-1px); }

/* ── STATS ── */
.stats-bar { background: var(--card); border-bottom: 1px solid var(--border); }
.stats-inner { max-width: 1200px; margin: auto; padding: 20px 24px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
.stat-item { display: flex; align-items: center; gap: 12px; }
.stat-icon { width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
.stat-value { font-size: 22px; font-weight: 800; color: var(--text); }
.stat-label { font-size: 12px; color: var(--muted); }

/* ── SECTION GRID ── */
.section-title { font-size: 20px; font-weight: 700; color: var(--text); }
.section-sub { font-size: 13px; color: var(--muted); margin-top: 3px; }
.section-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; }
.link-more { display: flex; align-items: center; gap: 4px; color: var(--primary); font-size: 13px; font-weight: 600; text-decoration: none; }
.link-more:hover { text-decoration: underline; }

/* ── CATEGORY CARDS ── */
.cat-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 12px; }
.cat-card { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 16px 12px; display: flex; flex-direction: column; align-items: center; gap: 10px; transition: all .2s; text-decoration: none; cursor: pointer; }
.cat-card:hover { border-color: var(--primary); transform: translateY(-2px); box-shadow: var(--shadow); }
.cat-icon-wrap { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
.cat-name { font-size: 12px; font-weight: 600; color: var(--text); text-align: center; }
.cat-count { font-size: 11px; color: var(--muted); }

/* ── FEATURE CARDS ── */
.feature-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
.feature-card { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 16px; display: flex; align-items: flex-start; gap: 12px; transition: all .2s; cursor: pointer; }
.feature-card:hover { border-color: rgba(26,111,181,0.3); transform: translateY(-2px); box-shadow: var(--shadow); }
.feature-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
.feature-name { font-weight: 600; font-size: 13px; color: var(--text); line-height: 1.3; }
.feature-desc { font-size: 12px; color: var(--muted); margin-top: 4px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.feature-badge { display: inline-block; font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 20px; margin-top: 6px; }

/* ── HOME BOTTOM GRID ── */
.home-bottom { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
.event-item { display: flex; gap: 12px; padding: 14px; background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); margin-bottom: 10px; transition: all .2s; cursor: pointer; }
.event-item:hover { border-color: rgba(26,111,181,0.25); box-shadow: var(--shadow); }
.event-bar { width: 4px; border-radius: 4px; background: var(--accent); flex-shrink: 0; min-height: 40px; }
.event-title { font-weight: 600; font-size: 14px; color: var(--text); }
.event-date { font-size: 12px; font-weight: 600; color: var(--primary); margin-top: 2px; }
.event-desc { font-size: 12px; color: var(--muted); margin-top: 4px; line-height: 1.5; }
.hours-card { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); overflow: hidden; }
.hours-row { display: flex; justify-content: space-between; align-items: center; padding: 11px 16px; border-bottom: 1px solid var(--border); }
.hours-row:last-child { border-bottom: none; }
.hours-row.today { background: rgba(26,111,181,0.05); }
.hours-day { font-size: 13px; font-weight: 500; color: var(--text); }
.hours-today-label { font-size: 10px; font-weight: 700; color: var(--primary); }
.hours-time { font-size: 13px; color: var(--muted); font-weight: 500; }
.hours-closed { color: var(--red); font-size: 11px; font-weight: 600; }
.contact-mini { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 14px; margin-top: 12px; }
.contact-mini p { font-size: 12px; color: var(--muted); line-height: 1.8; }

/* ── FLOOR MAP ── */
.map-page { display: grid; grid-template-columns: 1fr 280px; gap: 24px; align-items: start; }
.floor-tabs { display: flex; gap: 4px; background: rgba(0,0,0,0.05); border-radius: 10px; padding: 4px; margin-bottom: 16px; width: fit-content; }
.floor-tab { padding: 8px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; color: var(--muted); cursor: pointer; border: none; background: none; transition: all .2s; }
.floor-tab.active { background: var(--card); color: var(--text); box-shadow: var(--shadow); }
.map-wrap { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); overflow: hidden; position: relative; }
.map-grid { background-image: linear-gradient(rgba(0,0,0,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.04) 1px, transparent 1px); background-size: 40px 40px; }
.map-svg { width: 100%; display: block; min-height: 340px; }
.map-room { cursor: pointer; transition: all .2s; }
.map-room rect { transition: all .2s; }
.map-room:hover rect { filter: brightness(1.08); }
.map-sidebar { display: flex; flex-direction: column; gap: 14px; }
.sidebar-box { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); overflow: hidden; }
.sidebar-box-head { padding: 12px 16px; border-bottom: 1px solid var(--border); background: rgba(26,111,181,0.04); font-size: 13px; font-weight: 700; color: var(--text); }
.room-list-item { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-bottom: 1px solid var(--border); cursor: pointer; transition: background .15s; font-size: 13px; }
.room-list-item:last-child { border-bottom: none; }
.room-list-item:hover { background: #f5f7fa; }
.room-list-item.active { background: var(--primary-light); }
.room-icon { font-size: 16px; flex-shrink: 0; }
.room-name { font-weight: 600; color: var(--text); font-size: 12px; line-height: 1.2; }
.room-cap { font-size: 10px; color: var(--muted); }
.map-detail-panel { background: var(--primary-light); border: 2px solid var(--primary); border-radius: var(--radius); padding: 14px; }
.map-detail-icon { font-size: 26px; }
.map-detail-name { font-weight: 700; font-size: 14px; color: var(--text); margin: 4px 0 2px; }
.map-detail-floor { font-size: 11px; font-weight: 600; color: var(--primary); margin-bottom: 6px; }
.map-detail-desc { font-size: 12px; color: var(--muted); line-height: 1.5; }

/* ── SECTIONS PAGE ── */
.search-wrap { position: relative; margin-bottom: 6px; }
.search-wrap input { width: 100%; padding: 11px 16px 11px 40px; border: 1.5px solid var(--border); border-radius: 10px; font-size: 14px; background: var(--card); color: var(--text); outline: none; transition: border-color .2s; }
.search-wrap input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,111,181,0.1); }
.search-icon { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 16px; }
.filter-row { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; margin: 14px 0; }
.filter-label { font-size: 12px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.04em; }
.pill { padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; border: 1.5px solid var(--border); background: var(--card); color: var(--muted); cursor: pointer; transition: all .15s; }
.pill:hover { background: #f0f4fa; color: var(--text); }
.pill.active { color: #fff; border-color: transparent; box-shadow: 0 2px 6px rgba(0,0,0,0.12); }
.floor-divider { display: flex; align-items: center; gap: 12px; margin: 20px 0 14px; }
.floor-divider-line { flex: 1; height: 1px; background: var(--border); }
.floor-divider-label { font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em; white-space: nowrap; }
.sections-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
.section-card { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 16px; display: flex; align-items: flex-start; gap: 12px; transition: all .2s; cursor: pointer; }
.section-card:hover { border-color: rgba(26,111,181,0.3); box-shadow: var(--shadow); transform: translateY(-1px); }
.sc-icon { width: 46px; height: 46px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }
.sc-name { font-weight: 700; font-size: 14px; color: var(--text); line-height: 1.3; }
.sc-meta { display: flex; align-items: center; gap: 8px; margin-top: 3px; flex-wrap: wrap; }
.sc-badge { font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 20px; }
.sc-dewey { font-size: 11px; color: var(--muted); }
.sc-desc { font-size: 12px; color: var(--muted); margin-top: 6px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.sc-features { display: flex; flex-wrap: wrap; gap: 4px; margin-top: 8px; }
.sc-feat { font-size: 10px; padding: 2px 8px; border-radius: 20px; background: #f0f4fa; color: var(--muted); }
.sc-foot { display: flex; align-items: center; gap: 14px; margin-top: 8px; font-size: 11px; color: var(--muted); }

/* ── EVENTS PAGE ── */
.events-layout { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
.event-card { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 18px; margin-bottom: 12px; display: flex; gap: 14px; transition: all .2s; }
.event-card:hover { box-shadow: var(--shadow); transform: translateY(-1px); }
.event-type-icon { width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
.event-card-title { font-weight: 700; font-size: 15px; color: var(--text); }
.event-card-date { font-size: 12px; font-weight: 600; margin-top: 3px; }
.event-card-desc { font-size: 13px; color: var(--muted); margin-top: 6px; line-height: 1.6; }
.event-type-badge { display: inline-block; font-size: 10px; font-weight: 700; padding: 2px 9px; border-radius: 20px; margin-top: 6px; }
.programs-list { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); overflow: hidden; }
.program-item { padding: 13px 16px; border-bottom: 1px solid var(--border); }
.program-item:last-child { border-bottom: none; }
.program-name { font-weight: 600; font-size: 13px; color: var(--text); }
.program-sched { font-size: 11px; font-weight: 600; color: var(--primary); margin-top: 1px; }
.program-loc { font-size: 11px; color: var(--muted); margin-top: 1px; }
.newsletter-box { background: linear-gradient(135deg, rgba(26,111,181,0.08), rgba(245,158,11,0.05)); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 18px; margin-top: 14px; }
.newsletter-box h3 { font-weight: 700; font-size: 15px; color: var(--text); margin-bottom: 6px; }
.newsletter-box p { font-size: 12px; color: var(--muted); margin-bottom: 10px; line-height: 1.5; }
.newsletter-box input { width: 100%; padding: 9px 12px; border: 1.5px solid var(--border); border-radius: 8px; font-size: 13px; margin-bottom: 8px; outline: none; background: #fff; }
.newsletter-box input:focus { border-color: var(--primary); }
.closure-box { background: var(--red-light); border: 1.5px solid rgba(220,38,38,0.2); border-radius: var(--radius); padding: 14px; margin-top: 12px; }
.closure-box h4 { font-weight: 700; font-size: 13px; color: var(--red); margin-bottom: 8px; }
.closure-box ul { list-style: none; }
.closure-box li { font-size: 12px; color: #7f1d1d; padding: 2px 0; display: flex; align-items: center; gap: 6px; }
.closure-box li::before { content: '•'; color: var(--red); }

/* ── CONTACT PAGE ── */
.contact-layout { display: grid; grid-template-columns: 1fr 2fr; gap: 24px; }
.info-card { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); overflow: hidden; }
.info-card-head { padding: 14px 18px; border-bottom: 1px solid var(--border); background: rgba(26,111,181,0.04); font-weight: 700; font-size: 14px; color: var(--text); }
.info-item { display: flex; gap: 12px; padding: 14px 18px; border-bottom: 1px solid var(--border); }
.info-item:last-child { border-bottom: none; }
.info-item-icon { width: 34px; height: 34px; border-radius: 8px; background: var(--primary-light); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
.info-item-label { font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.04em; }
.info-item-val { font-size: 13px; color: var(--text); margin-top: 2px; line-height: 1.5; }
.map-placeholder { background: linear-gradient(135deg, #e8f0fe, #f0f4fa); border: 1.5px solid var(--border); border-radius: var(--radius); height: 160px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px; text-align: center; margin-top: 12px; }
.dept-card { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-top: 12px; }
.dept-item { padding: 11px 16px; border-bottom: 1px solid var(--border); }
.dept-item:last-child { border-bottom: none; }
.dept-name { font-weight: 600; font-size: 12px; color: var(--text); }
.dept-phone { font-size: 11px; color: var(--muted); margin-top: 1px; }
.dept-email { font-size: 11px; color: var(--primary); }
.form-card { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); overflow: hidden; }
.form-head { padding: 16px 22px; border-bottom: 1px solid var(--border); background: rgba(26,111,181,0.04); }
.form-head h2 { font-weight: 700; font-size: 16px; color: var(--text); }
.form-head p { font-size: 12px; color: var(--muted); margin-top: 2px; }
.form-body { padding: 22px; }
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
.form-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 14px; }
.form-group label { font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.04em; }
.form-group input, .form-group select, .form-group textarea { padding: 10px 14px; border: 1.5px solid var(--border); border-radius: 8px; font-size: 13px; font-family: inherit; color: var(--text); background: #f8f9fb; outline: none; transition: border-color .2s; }
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,111,181,0.1); }
.form-group textarea { resize: vertical; min-height: 120px; }
.form-success { display: flex; flex-direction: column; align-items: center; padding: 40px; text-align: center; }
.success-icon { font-size: 48px; margin-bottom: 12px; }
.faq-wrap { background: var(--card); border: 1.5px solid var(--border); border-radius: var(--radius); overflow: hidden; margin-top: 20px; }
.faq-head { padding: 14px 20px; border-bottom: 1px solid var(--border); font-weight: 700; font-size: 15px; color: var(--text); }
.faq-item { border-bottom: 1px solid var(--border); }
.faq-item:last-child { border-bottom: none; }
.faq-q { width: 100%; text-align: left; padding: 14px 20px; font-size: 13px; font-weight: 600; color: var(--text); background: none; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center; gap: 8px; transition: background .15s; }
.faq-q:hover { background: #f8f9fb; }
.faq-toggle { font-size: 18px; color: var(--primary); flex-shrink: 0; }
.faq-a { padding: 0 20px 14px; font-size: 13px; color: var(--muted); line-height: 1.7; display: none; }
.faq-a.open { display: block; }

/* ── FOOTER ── */
footer { background: var(--card); border-top: 1px solid var(--border); margin-top: auto; }
.footer-inner { max-width: 1200px; margin: auto; padding: 40px 24px 20px; }
.footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1.2fr; gap: 32px; margin-bottom: 32px; }
.footer-brand p { font-size: 13px; color: var(--muted); line-height: 1.7; margin-top: 10px; }
.social-icons { display: flex; gap: 8px; margin-top: 14px; }
.social-btn { width: 32px; height: 32px; border-radius: 8px; background: #f0f4fa; display: flex; align-items: center; justify-content: center; font-size: 14px; cursor: pointer; transition: all .2s; border: none; }
.social-btn:hover { background: var(--primary); color: #fff; }
.footer-col h3 { font-size: 13px; font-weight: 700; color: var(--text); margin-bottom: 12px; }
.footer-col ul { list-style: none; }
.footer-col li { margin-bottom: 7px; }
.footer-col a { font-size: 13px; color: var(--muted); text-decoration: none; transition: color .15s; }
.footer-col a:hover { color: var(--primary); }
.footer-hours p { font-size: 13px; color: var(--muted); margin-bottom: 4px; }
.footer-hours p strong { color: var(--text); }
.footer-bottom { border-top: 1px solid var(--border); padding-top: 18px; display: flex; justify-content: space-between; align-items: center; flex-wrap: gap; gap: 12px; }
.footer-bottom p { font-size: 12px; color: var(--muted); }
.footer-links { display: flex; gap: 16px; }
.footer-links a { font-size: 12px; color: var(--muted); text-decoration: none; }
.footer-links a:hover { color: var(--primary); }

/* ── MODAL ── */
.modal-overlay { display: none; position: fixed; inset: 0; z-index: 200; background: rgba(0,0,0,0.35); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 16px; }
.modal-overlay.open { display: flex; }
.modal { background: var(--card); border-radius: 16px; width: 100%; max-width: 480px; box-shadow: var(--shadow-lg); overflow: hidden; animation: slideUp .3s ease; }
@keyframes slideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
.modal-header { padding: 18px 20px 14px; }
.modal-title { font-size: 17px; font-weight: 700; color: var(--text); margin-bottom: 3px; }
.modal-close { float: right; width: 30px; height: 30px; border-radius: 50%; background: #f0f4fa; border: none; cursor: pointer; font-size: 16px; display: flex; align-items: center; justify-content: center; transition: background .15s; }
.modal-close:hover { background: #e0e7ef; }
.modal-body { padding: 0 20px 6px; max-height: 60vh; overflow-y: auto; }
.modal-footer { padding: 14px 20px; display: flex; gap: 10px; border-top: 1px solid var(--border); }
.modal-stat-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin: 12px 0; }
.modal-stat { background: #f8f9fb; border-radius: 10px; padding: 12px; }
.modal-stat-label { font-size: 10px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px; }
.modal-stat-value { font-size: 17px; font-weight: 800; color: var(--text); }
.modal-stat-sub { font-size: 10px; color: var(--muted); }
.hours-box { background: rgba(26,111,181,0.06); border: 1px solid rgba(26,111,181,0.15); border-radius: 10px; padding: 12px 14px; margin: 10px 0; }
.hours-box-title { font-size: 12px; font-weight: 700; color: var(--text); margin-bottom: 6px; }
.hours-box p { font-size: 12px; color: var(--muted); margin-bottom: 2px; }
.features-list { display: grid; grid-template-columns: 1fr 1fr; gap: 6px; margin-top: 10px; }
.feat-item { display: flex; align-items: flex-start; gap: 6px; font-size: 12px; color: var(--muted); }
.feat-check { width: 14px; height: 14px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 9px; flex-shrink: 0; margin-top: 1px; }

/* ── UTILITY ── */
.page-section { padding: 36px 0; }
.mt-4 { margin-top: 16px; }
.mt-6 { margin-top: 24px; }
.no-results { text-align: center; padding: 60px 20px; }
.no-results-icon { font-size: 48px; margin-bottom: 12px; }
.alert-info { background: var(--primary-light); border: 1px solid rgba(26,111,181,0.2); border-radius: 10px; padding: 12px 16px; font-size: 13px; color: var(--primary); margin-bottom: 16px; }
.alert-success { background: var(--green-light); border: 1px solid rgba(22,163,74,0.2); border-radius: 10px; padding: 12px 16px; font-size: 13px; color: var(--green); margin-bottom: 16px; }

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
  .cat-grid { grid-template-columns: repeat(3, 1fr); }
  .feature-grid { grid-template-columns: repeat(2, 1fr); }
  .footer-grid { grid-template-columns: 1fr 1fr; }
  .map-page { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
  .nav-links { display: none; }
  .hamburger { display: flex; }
  .stats-inner { grid-template-columns: repeat(2, 1fr); }
  .feature-grid { grid-template-columns: 1fr; }
  .home-bottom { grid-template-columns: 1fr; }
  .events-layout { grid-template-columns: 1fr; }
  .contact-layout { grid-template-columns: 1fr; }
  .form-grid { grid-template-columns: 1fr; }
  .sections-grid { grid-template-columns: 1fr; }
  .footer-grid { grid-template-columns: 1fr; }
  .cat-grid { grid-template-columns: repeat(2, 1fr); }
  .hero h1 { font-size: 26px; }
  .topbar { font-size: 11px; }
}
@media (max-width: 480px) {
  .stats-inner { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<!-- TOP BAR -->
<div class="topbar">
  <span>📚 City Public Library &nbsp;·&nbsp; Open Today 8am–8pm</span>
  <span><span>📞 (555) 234-5678</span>&emsp;<span>📍 123 Library Ave, City Center</span></span>
</div>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="navbar-inner">
    <a href="?page=home" class="logo">
      <div class="logo-icon">📖</div>
      <div class="logo-text">
        <div class="logo-title">City Public</div>
        <div class="logo-sub">Library</div>
      </div>
    </a>
    <div class="nav-links">
      <?php
      $nav = [
        'home'     => ['🏠','Home'],
        'map'      => ['🗺️','Floor Map'],
        'sections' => ['🔍','All Sections'],
        'events'   => ['📅','Events & News'],
        'contact'  => ['📞','Contact'],
      ];
      foreach($nav as $pg => [$icon,$label]) {
        $active = $page === $pg ? 'active' : '';
        echo "<a href='?page=$pg' class='nav-link $active'><span class='nav-icon'>$icon</span>$label</a>";
      }
      ?>
    </div>
    <button class="hamburger" onclick="toggleMenu()" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
  <div class="mobile-menu" id="mobileMenu">
    <?php foreach($nav as $pg => [$icon,$label]) {
      $active = $page === $pg ? 'active' : '';
      echo "<a href='?page=$pg' class='nav-link $active'><span class='nav-icon'>$icon</span>$label</a>";
    } ?>
  </div>
</nav>

<!-- MAIN CONTENT -->
<main>
<?php
// ════════════════════════════════════════════
//  DATA
// ════════════════════════════════════════════
$sections = [
  // Floor 1
  ['id'=>'entrance',      'name'=>'Main Entrance & Info Desk',     'floor'=>1,'cat'=>'services','color'=>'#d97706','light'=>'#fef3c7','icon'=>'🏛️','cap'=>50,  'desc'=>'Welcome to City Public Library! Our information desk staff are ready to help you navigate our collection, register for a library card, or answer any questions.', 'hours'=>'Mon–Fri: 8am–8pm | Sat: 9am–6pm | Sun: 10am–4pm', 'features'=>['Information Desk','Library Card Registration','Lost & Found','Coat Check','Accessibility Assistance'],'dewey'=>''],
  ['id'=>'circulation',   'name'=>'Circulation & Checkout',         'floor'=>1,'cat'=>'services','color'=>'#b45309','light'=>'#fef3c7','icon'=>'📚','cap'=>30, 'desc'=>'Check out books, return items, renew loans, and manage your library account. Self-checkout kiosks available.','hours'=>'Mon–Fri: 8am–8pm | Sat: 9am–6pm | Sun: 10am–4pm','features'=>['Book Checkout','Returns Drop','Self-Checkout Kiosks','Account Management','Interlibrary Loans'],'dewey'=>''],
  ['id'=>'new-arrivals',  'name'=>'New Arrivals',                   'floor'=>1,'cat'=>'reading', 'color'=>'#2563eb','light'=>'#dbeafe','icon'=>'✨','cap'=>40, 'desc'=>'Discover our latest acquisitions — bestsellers, award winners, and newly published works. Updated weekly.','hours'=>'Open during library hours','features'=>['Recent Bestsellers','Award Winners','Staff Picks','New Non-Fiction','New DVDs & CDs'],'dewey'=>''],
  ['id'=>'periodicals',   'name'=>'Periodicals & Newspapers',       'floor'=>1,'cat'=>'reading', 'color'=>'#1d4ed8','light'=>'#dbeafe','icon'=>'📰','cap'=>60, 'desc'=>'Current and back issues of newspapers, magazines, and journals. Comfortable seating for leisurely reading.','hours'=>'Open during library hours','features'=>['Daily Newspapers','500+ Magazines','Academic Journals','Microfilm Archive','Digital Terminals'],'dewey'=>''],
  ['id'=>'children',      'name'=>'Children\'s Library',            'floor'=>1,'cat'=>'children','color'=>'#16a34a','light'=>'#dcfce7','icon'=>'🧒','cap'=>80, 'desc'=>'A magical world for young readers with picture books, early readers, and engaging activities. Storytime every weekend.','hours'=>'Mon–Sat: 9am–6pm | Sun: 10am–4pm','features'=>['Picture Books','Early Readers','Storytime Sessions','Puzzle Corner','Educational Toys','Youth Programs'],'dewey'=>''],
  ['id'=>'cafe',          'name'=>'Library Café',                   'floor'=>1,'cat'=>'services','color'=>'#92400e','light'=>'#fef3c7','icon'=>'☕','cap'=>40, 'desc'=>'Relax with a coffee or snack in our cozy café. Light meals, pastries, and hot drinks available.','hours'=>'Mon–Fri: 8am–7pm | Sat: 9am–5pm | Sun: 10am–3pm','features'=>['Hot Beverages','Light Meals','Pastries & Snacks','Free WiFi','Outdoor Seating'],'dewey'=>''],
  ['id'=>'gift-shop',     'name'=>'Gift Shop',                      'floor'=>1,'cat'=>'services','color'=>'#7c2d12','light'=>'#fef3c7','icon'=>'🛍️','cap'=>20,'desc'=>'Browse our curated books, bookmarks, stationery, and library merchandise. Proceeds support library programs.','hours'=>'Mon–Sat: 9am–5pm | Sun: 11am–3pm','features'=>['Books for Sale','Bookmarks & Stationery','Library Merchandise','Gift Cards','Used Book Sales'],'dewey'=>''],
  // Floor 2
  ['id'=>'fiction',       'name'=>'Fiction Collection',             'floor'=>2,'cat'=>'reading', 'color'=>'#2563eb','light'=>'#dbeafe','icon'=>'📖','cap'=>100,'desc'=>'Thousands of fiction titles spanning every genre — literary, thriller, romance, sci-fi, fantasy, and historical fiction.','hours'=>'Open during library hours','features'=>['Literary Fiction','Mystery & Thriller','Romance','Science Fiction','Fantasy','Historical Fiction','Short Stories'],'dewey'=>'800–899'],
  ['id'=>'nonfiction',    'name'=>'Non-Fiction Collection',         'floor'=>2,'cat'=>'reading', 'color'=>'#1e40af','light'=>'#dbeafe','icon'=>'🌍','cap'=>100,'desc'=>'Comprehensive non-fiction covering history, science, biography, travel, self-help, cooking, and more.','hours'=>'Open during library hours','features'=>['History & Politics','Science & Nature','Biographies','Travel','Self-Help','Cooking','Arts & Crafts'],'dewey'=>'000–799'],
  ['id'=>'study-rooms',   'name'=>'Study Rooms',                    'floor'=>2,'cat'=>'study',   'color'=>'#0891b2','light'=>'#cffafe','icon'=>'🚪','cap'=>30, 'desc'=>'Six private study rooms available for reservation. Ideal for group projects, tutoring, or focused individual work.','hours'=>'Mon–Fri: 8am–9pm | Sat–Sun: 9am–6pm','features'=>['6 Private Rooms','Whiteboards','TV Screens','Bookable Online','2-Hour Slots','Group Bookings'],'dewey'=>''],
  ['id'=>'quiet-reading', 'name'=>'Quiet Reading Room',             'floor'=>2,'cat'=>'study',   'color'=>'#164e63','light'=>'#cffafe','icon'=>'🤫','cap'=>50, 'desc'=>'A serene silent zone dedicated to deep focus. No phone calls. Perfect for extended reading and research.','hours'=>'Open during library hours','features'=>['Silent Zone','Individual Desks','Natural Lighting','Ergonomic Seating','Power Outlets'],'dewey'=>''],
  ['id'=>'computers',     'name'=>'Computer & Internet Lab',        'floor'=>2,'cat'=>'services','color'=>'#d97706','light'=>'#fef3c7','icon'=>'💻','cap'=>30, 'desc'=>'30 public-access computers with high-speed internet, printing, scanning, and fax services.','hours'=>'Mon–Fri: 8am–8pm | Sat: 9am–6pm | Sun: 10am–4pm','features'=>['30 Public PCs','High-Speed WiFi','Printing (B&W & Color)','Scanning','Fax Service','Job Search Tools'],'dewey'=>''],
  ['id'=>'audiovisual',   'name'=>'Audio-Visual Collection',        'floor'=>2,'cat'=>'media',   'color'=>'#db2777','light'=>'#fce7f3','icon'=>'🎬','cap'=>40, 'desc'=>'DVDs, Blu-rays, music CDs, audiobooks, and vinyl records. On-site listening and viewing stations.','hours'=>'Open during library hours','features'=>['DVDs & Blu-rays','Music CDs','Audiobooks on CD','Vinyl Records','Listening Stations','Viewing Booths'],'dewey'=>''],
  // Floor 3
  ['id'=>'reference',     'name'=>'Reference & Research',           'floor'=>3,'cat'=>'research','color'=>'#7c3aed','light'=>'#ede9fe','icon'=>'🔍','cap'=>60, 'desc'=>'Expert reference librarians assist with in-depth research. Access to encyclopedias, legal references, and statistical resources.','hours'=>'Mon–Fri: 9am–7pm | Sat: 10am–5pm','features'=>['Reference Librarians','Encyclopedias','Legal Resources','Statistical Data','Research Databases','Citation Help'],'dewey'=>'000–099'],
  ['id'=>'local-history', 'name'=>'Local History & Archives',       'floor'=>3,'cat'=>'research','color'=>'#6d28d9','light'=>'#ede9fe','icon'=>'🗺️','cap'=>20, 'desc'=>'Discover our city\'s history through photographs, maps, newspapers, and archival documents dating back to the 1800s.','hours'=>'Tue & Thu: 10am–5pm | Sat: 10am–3pm','features'=>['Historical Photographs','City Maps','Census Records','Genealogy Resources','Newspaper Archives','Oral History Recordings'],'dewey'=>''],
  ['id'=>'special',       'name'=>'Special Collections',            'floor'=>3,'cat'=>'research','color'=>'#5b21b6','light'=>'#ede9fe','icon'=>'📜','cap'=>10, 'desc'=>'Rare books, manuscripts, first editions, and unique materials requiring special handling. Appointment recommended.','hours'=>'By appointment: Mon, Wed, Fri 10am–4pm','features'=>['Rare Books','First Editions','Manuscripts','Maps & Prints','By Appointment','White Glove Required'],'dewey'=>''],
  ['id'=>'digital-lab',   'name'=>'Digital Media Lab',              'floor'=>3,'cat'=>'media',   'color'=>'#be185d','light'=>'#fce7f3','icon'=>'🎙️','cap'=>25,'desc'=>'Create digital content with professional equipment. Podcast booth, video editing, 3D printing, and graphic design software.','hours'=>'Mon–Fri: 10am–7pm | Sat: 10am–5pm','features'=>['Podcast Recording Booth','Video Editing','3D Printing','Graphic Design Software','Digitization Services','Maker Workshops'],'dewey'=>''],
  ['id'=>'seminar',       'name'=>'Seminar & Event Room',           'floor'=>3,'cat'=>'study',   'color'=>'#0e7490','light'=>'#cffafe','icon'=>'🎤','cap'=>100,'desc'=>'Multipurpose space for lectures, workshops, author readings, and community events. Seats up to 100 with full AV.','hours'=>'By booking — contact library for reservations','features'=>['100-Seat Capacity','Projector & Screen','Podium & Microphone','Flexible Seating','Catering Available','Community Events'],'dewey'=>''],
];

$categories = [
  'all'=>['All','#6b7a8d','#f0f4fa'],
  'reading'=>['Reading','#2563eb','#dbeafe'],
  'research'=>['Research','#7c3aed','#ede9fe'],
  'media'=>['Media','#db2777','#fce7f3'],
  'children'=>['Children','#16a34a','#dcfce7'],
  'services'=>['Services','#d97706','#fef3c7'],
  'study'=>['Study','#0891b2','#cffafe'],
];
$catIcons = ['reading'=>'📖','research'=>'🔬','media'=>'🎬','children'=>'🧒','services'=>'🛎️','study'=>'📝'];

$announcements = [
  ['id'=>'a1','title'=>'Summer Reading Challenge 2026','date'=>'June 1 – August 31','type'=>'event','desc'=>'Join our annual summer reading challenge! Readers of all ages can win prizes for completing books and reading activities.'],
  ['id'=>'a2','title'=>'New Digital Resources Available','date'=>'June 10, 2026','type'=>'update','desc'=>'We\'ve expanded our digital library with 5,000 new e-books and audiobooks accessible 24/7 with your library card.'],
  ['id'=>'a3','title'=>'Author Talk: Sarah Mitchell','date'=>'June 22, 2026 at 6pm','type'=>'event','desc'=>'Award-winning author Sarah Mitchell visits to discuss her new novel \'The Amber House\'. Free, registration required.'],
  ['id'=>'a4','title'=>'Special Collections: Extended Hours','date'=>'June 15–30, 2026','type'=>'update','desc'=>'Special Collections will be open Fridays until 6pm for the duration of the local history exhibit.'],
  ['id'=>'a5','title'=>'3D Printing Workshop','date'=>'June 18, 2026 at 2pm','type'=>'event','desc'=>'Learn the basics of 3D printing in our Digital Media Lab. Suitable for beginners. Limited spots — register at the info desk.'],
  ['id'=>'a6','title'=>'Holiday Closure Notice','date'=>'June 19, 2026','type'=>'closure','desc'=>'The library will be closed on June 19th in observance of Juneteenth. Normal operations resume June 20th.'],
];

$typeConfig = [
  'event'=>['label'=>'Event','color'=>'#2563eb','bg'=>'#dbeafe','icon'=>'📅'],
  'update'=>['label'=>'Update','color'=>'#16a34a','bg'=>'#dcfce7','icon'=>'🔄'],
  'news'=>['label'=>'News','color'=>'#d97706','bg'=>'#fef3c7','icon'=>'📢'],
  'closure'=>['label'=>'Closure','color'=>'#dc2626','bg'=>'#fee2e2','icon'=>'🚫'],
];

$floorNames = [1=>'Ground Floor', 2=>'Second Floor', 3=>'Third Floor'];

// ════════════════════════════════════════════
//  PAGES
// ════════════════════════════════════════════
if ($page === 'home') :
?>

<!-- ── HOME PAGE ── -->
<section class="hero">
  <div class="hero-inner">
    <div class="hero-badge">⭐ Established 1892 · City's Oldest Public Library</div>
    <h1>Explore Every Corner of <span>City Public Library</span></h1>
    <p>Navigate our 3-floor library with an interactive map. Find books, study rooms, media labs, children's sections, and more — all in one place.</p>
    <div class="hero-btns">
      <a href="?page=map" class="btn-primary">🗺️ View Interactive Map</a>
      <a href="?page=sections" class="btn-secondary">🔍 Browse All Sections</a>
    </div>
  </div>
</section>

<div class="stats-bar">
  <div class="stats-inner">
    <?php foreach([
      ['📚','120,000+','Books & Resources','#dbeafe'],
      ['🗺️','15+','Reading Sections','#ede9fe'],
      ['👥','3,500+','Weekly Visitors','#dcfce7'],
      ['🕐','60+','Open Hours/Week','#fef3c7'],
    ] as [$icon,$val,$label,$bg]) : ?>
    <div class="stat-item">
      <div class="stat-icon" style="background:<?=$bg?>"><?=$icon?></div>
      <div><div class="stat-value"><?=$val?></div><div class="stat-label"><?=$label?></div></div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="container">
  <!-- Category Browse -->
  <div class="page-section">
    <div class="section-header">
      <div><div class="section-title">Browse by Category</div><div class="section-sub">Find exactly what you need</div></div>
    </div>
    <div class="cat-grid">
      <?php foreach($categories as $key=>[$label,$color,$bg]) :
        if($key==='all') continue;
        $count = count(array_filter($sections,fn($s)=>$s['cat']===$key));
        $icon = $catIcons[$key] ?? '📁';
      ?>
      <a href="?page=sections&cat=<?=$key?>" class="cat-card">
        <div class="cat-icon-wrap" style="background:<?=$bg?>"><?=$icon?></div>
        <div class="cat-name"><?=$label?></div>
        <div class="cat-count"><?=$count?> section<?=$count!==1?'s':''?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Featured sections -->
  <div class="page-section" style="padding-top:0">
    <div class="section-header">
      <div><div class="section-title">Popular Sections</div><div class="section-sub">Most visited areas of the library</div></div>
      <a href="?page=sections" class="link-more">View all ›</a>
    </div>
    <div class="feature-grid">
      <?php foreach(array_slice($sections,0,6) as $s) : ?>
      <div class="feature-card" onclick="openModal('<?=$s['id']?>')">
        <div class="feature-icon" style="background:<?=$s['light']?>"><?=$s['icon']?></div>
        <div>
          <div class="feature-name"><?=htmlspecialchars($s['name'])?></div>
          <div class="feature-desc"><?=htmlspecialchars($s['desc'])?></div>
          <div class="feature-badge" style="background:<?=$s['light']?>;color:<?=$s['color']?>">Floor <?=$s['floor']?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Home bottom grid -->
  <div class="home-bottom page-section" style="padding-top:0">
    <div>
      <div class="section-header">
        <div><div class="section-title">Upcoming Events</div><div class="section-sub">Don't miss these</div></div>
        <a href="?page=events" class="link-more">All events ›</a>
      </div>
      <?php foreach(array_filter($announcements,fn($a)=>$a['type']==='event') as $ev) : ?>
      <a href="?page=events" class="event-item" style="display:flex">
        <div class="event-bar"></div>
        <div>
          <div class="event-title"><?=htmlspecialchars($ev['title'])?></div>
          <div class="event-date"><?=htmlspecialchars($ev['date'])?></div>
          <div class="event-desc"><?=htmlspecialchars($ev['desc'])?></div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <div>
      <div class="section-title mb-4" style="margin-bottom:14px">Library Hours</div>
      <div class="hours-card">
        <div class="hours-row today">
          <div><div class="hours-day">Monday – Friday</div><div class="hours-today-label">TODAY</div></div>
          <div class="hours-time">8:00am – 8:00pm</div>
        </div>
        <div class="hours-row"><div class="hours-day">Saturday</div><div class="hours-time">9:00am – 6:00pm</div></div>
        <div class="hours-row"><div class="hours-day">Sunday</div><div class="hours-time">10:00am – 4:00pm</div></div>
        <div class="hours-row"><div class="hours-closed">Closed on public holidays</div></div>
      </div>
      <div class="contact-mini">
        <div class="section-title" style="font-size:14px;margin-bottom:8px">Quick Contact</div>
        <p>📞 (555) 234-5678<br>📧 info@citylibrary.org<br>📍 123 Library Ave, City Center</p>
      </div>
    </div>
  </div>
</div>

<?php elseif ($page === 'map') : ?>

<!-- ── MAP PAGE ── -->
<div class="container">
  <div class="page-header">
    <h1>🗺️ Interactive Floor Map</h1>
    <p>Click any room to see its full details. Switch between floors using the tabs below.</p>
  </div>

  <div id="mapPage" class="map-page">
    <!-- Map Area -->
    <div>
      <div class="floor-tabs">
        <?php for($f=1;$f<=3;$f++):
          $cnt=count(array_filter($sections,fn($s)=>$s['floor']===$f));
        ?>
        <button class="floor-tab <?=$f===1?'active':''?>" onclick="switchFloor(<?=$f?>)" id="tab<?=$f?>">
          Floor <?=$f?> <small style="opacity:.6;font-size:11px">(<?=$cnt?>)</small>
        </button>
        <?php endfor; ?>
      </div>

      <?php for($f=1;$f<=3;$f++): $floorSecs=array_values(array_filter($sections,fn($s)=>$s['floor']===$f)); ?>
      <div id="floor<?=$f?>" class="map-wrap map-grid" style="display:<?=$f===1?'block':'none'?>">
        <svg id="svg<?=$f?>" viewBox="0 0 720 480" class="map-svg">
          <!-- Background -->
          <rect width="720" height="480" fill="transparent"/>
          <!-- Outer walls -->
          <rect x="15" y="15" width="690" height="450" rx="8" fill="none" stroke="#cbd5e1" stroke-width="2.5"/>
          <!-- Floor label -->
          <text x="360" y="38" text-anchor="middle" font-size="13" font-weight="600" fill="#94a3b8"><?=$floorNames[$f]?> · City Public Library</text>
          <!-- Compass -->
          <circle cx="670" cy="430" r="20" fill="white" stroke="#e2e8f0" stroke-width="1.5"/>
          <text x="670" y="424" text-anchor="middle" font-size="11" font-weight="bold" fill="#1a6fb5">N</text>
          <text x="670" y="440" text-anchor="middle" font-size="9" fill="#94a3b8">S</text>
          <text x="655" y="433" text-anchor="middle" font-size="9" fill="#94a3b8">W</text>
          <text x="685" y="433" text-anchor="middle" font-size="9" fill="#94a3b8">E</text>
          <line x1="670" y1="412" x2="670" y2="422" stroke="#1a6fb5" stroke-width="2" stroke-linecap="round"/>
          <!-- Elevator -->
          <rect x="672" y="55" width="26" height="30" rx="3" fill="none" stroke="#cbd5e1" stroke-width="1.5"/>
          <text x="685" y="76" text-anchor="middle" font-size="8" fill="#94a3b8">LIFT</text>

          <?php
          // Floor-specific layout coordinates
          $coords = [
            1 => [
              'entrance'   => [30,70,160,100],
              'circulation'=> [210,70,160,100],
              'new-arrivals'=> [30,190,150,130],
              'periodicals'=> [200,190,155,130],
              'children'   => [375,70,195,250],
              'cafe'       => [590,70,110,130],
              'gift-shop'  => [590,220,110,100],
            ],
            2 => [
              'fiction'    => [30,70,210,150],
              'nonfiction' => [260,70,205,150],
              'study-rooms'=> [485,70,200,150],
              'quiet-reading'=>[30,240,210,110],
              'computers'  => [260,240,205,110],
              'audiovisual'=> [485,240,200,110],
            ],
            3 => [
              'reference'  => [30,70,225,170],
              'local-history'=>[275,70,205,170],
              'special'    => [500,70,185,170],
              'digital-lab'=> [30,260,225,130],
              'seminar'    => [275,260,410,130],
            ],
          ];
          foreach($floorSecs as $sec):
            $id = $sec['id'];
            $c = $coords[$f][$id] ?? null;
            if(!$c) continue;
            [$x,$y,$w,$h] = $c;
            $cx = $x + $w/2;
            $cy = $y + $h/2;
          ?>
          <g class="map-room" onclick="openModal('<?=$id?>')" title="<?=htmlspecialchars($sec['name'])?>">
            <rect id="room-<?=$id?>" x="<?=$x?>" y="<?=$y?>" width="<?=$w?>" height="<?=$h?>" rx="7"
              fill="<?=$sec['color']?>" fill-opacity="0.18"
              stroke="<?=$sec['color']?>" stroke-width="1.8" stroke-opacity="0.75"/>
            <text x="<?=$cx?>" y="<?=($cy-10)?>" text-anchor="middle" font-size="<?=$h>90?18:15?>" style="pointer-events:none;user-select:none"><?=$sec['icon']?></text>
            <text x="<?=$cx?>" y="<?=($cy+8)?>" text-anchor="middle" font-size="9.5" font-weight="600" fill="<?=$sec['color']?>" style="pointer-events:none;user-select:none">
              <?=mb_substr(htmlspecialchars($sec['name']),0,22)?>
            </text>
            <?php if($h>=95): ?>
            <text x="<?=$cx?>" y="<?=($cy+20)?>" text-anchor="middle" font-size="8" fill="<?=$sec['color']?>" fill-opacity="0.7" style="pointer-events:none;user-select:none">Cap: <?=$sec['cap']?></text>
            <?php endif; ?>
          </g>
          <?php endforeach; ?>
        </svg>
        <div style="text-align:center;padding:8px 0 10px;font-size:12px;color:var(--muted)">
          <?=$floorNames[$f]?> · <?=count($floorSecs)?> sections · Click any room for details
        </div>
      </div>
      <?php endfor; ?>
    </div>

    <!-- Sidebar -->
    <div class="map-sidebar">
      <div class="sidebar-box" id="mapDetailBox" style="display:none">
        <div class="sidebar-box-head">Selected Room</div>
        <div id="mapDetailContent" style="padding:14px"></div>
      </div>

      <div class="sidebar-box">
        <div class="sidebar-box-head" id="sidebarFloorLabel">Ground Floor — Rooms</div>
        <div id="roomList"></div>
      </div>
    </div>
  </div>
</div>

<script>
var sectionsData = <?=json_encode(array_values($sections))?>;
var currentFloor = 1;

function switchFloor(f) {
  currentFloor = f;
  [1,2,3].forEach(function(n){
    document.getElementById('floor'+n).style.display = n===f?'block':'none';
    document.getElementById('tab'+n).classList.toggle('active', n===f);
  });
  var names = {1:'Ground Floor',2:'Second Floor',3:'Third Floor'};
  document.getElementById('sidebarFloorLabel').textContent = names[f] + ' — Rooms';
  document.getElementById('mapDetailBox').style.display = 'none';
  renderRoomList(f);
}

function renderRoomList(f) {
  var list = document.getElementById('roomList');
  var fl = sectionsData.filter(function(s){ return s.floor===f; });
  list.innerHTML = fl.map(function(s){
    return '<div class="room-list-item" id="li-'+s.id+'" onclick="openModal(\''+s.id+'\')">' +
      '<span class="room-icon">'+s.icon+'</span>' +
      '<div><div class="room-name">'+s.name+'</div><div class="room-cap">Cap: '+s.cap+'</div></div></div>';
  }).join('');
}

renderRoomList(1);

function openModal(id) {
  var s = sectionsData.find(function(x){ return x.id===id; });
  if(!s) return;

  // Highlight on SVG
  document.querySelectorAll('[id^="room-"]').forEach(function(r){
    r.setAttribute('fill-opacity','0.18');
    r.setAttribute('stroke-width','1.8');
  });
  var el = document.getElementById('room-'+id);
  if(el){ el.setAttribute('fill-opacity','0.38'); el.setAttribute('stroke-width','2.8'); }

  // Highlight sidebar
  document.querySelectorAll('.room-list-item').forEach(function(r){ r.classList.remove('active'); });
  var li = document.getElementById('li-'+id);
  if(li) li.classList.add('active');

  // Sidebar detail
  var box = document.getElementById('mapDetailBox');
  var content = document.getElementById('mapDetailContent');
  box.style.display = 'block';
  content.innerHTML = '<div class="map-detail-icon">'+s.icon+'</div>' +
    '<div class="map-detail-name">'+s.name+'</div>' +
    '<div class="map-detail-floor">Floor '+s.floor+'</div>' +
    '<div class="map-detail-desc">'+s.desc+'</div>' +
    '<button class="btn-primary" style="margin-top:10px;width:100%;justify-content:center;font-size:12px;padding:8px" onclick="openFullModal(\''+id+'\')">Full Details</button>';

  // Also open the full modal
  openFullModal(id);
}

function openFullModal(id) {
  var s = sectionsData.find(function(x){ return x.id===id; });
  if(!s) return;

  document.getElementById('modalIcon').textContent = s.icon;
  document.getElementById('modalTitle').textContent = s.name;
  document.getElementById('modalFloor').innerHTML = '<span style="background:'+s.color+';color:#fff;font-size:11px;font-weight:700;padding:2px 10px;border-radius:20px">Floor '+s.floor+'</span>';
  document.getElementById('modalDesc').textContent = s.desc;
  document.getElementById('modalCap').textContent = s.cap;
  document.getElementById('modalHours').innerHTML = s.hours.split('|').map(function(h){ return '<p>'+h.trim()+'</p>'; }).join('');
  document.getElementById('modalFeatures').innerHTML = s.features.map(function(f){
    return '<div class="feat-item"><div class="feat-check" style="background:'+s.color+'20;color:'+s.color+'">✓</div>'+f+'</div>';
  }).join('');
  document.getElementById('modalDebt').innerHTML = s.dewey ? '<p style="font-size:12px;color:var(--muted);margin-top:4px">Dewey Range: '+s.dewey+'</p>' : '';
  document.getElementById('modalMapBtn').onclick = function(){
    switchFloor(s.floor); closeModal(); openModal(s.id);
  };
  document.getElementById('sectionModal').classList.add('open');
}

function closeModal() {
  document.getElementById('sectionModal').classList.remove('open');
}
</script>

<?php elseif ($page === 'sections') :
  $activeCat = isset($_GET['cat']) && array_key_exists($_GET['cat'], $categories) ? $_GET['cat'] : 'all';
  $activeFloor = isset($_GET['floor']) && in_array((int)$_GET['floor'],[1,2,3]) ? (int)$_GET['floor'] : 0;
  $searchQ = isset($_GET['q']) ? strtolower(trim($_GET['q'])) : '';
?>

<!-- ── SECTIONS PAGE ── -->
<div class="container">
  <div class="page-header">
    <h1>🔍 All Library Sections</h1>
    <p><?=count($sections)?> sections across 3 floors</p>
  </div>

  <form method="get" action="">
    <input type="hidden" name="page" value="sections"/>
    <!-- Search -->
    <div class="search-wrap">
      <span class="search-icon">🔍</span>
      <input type="text" name="q" value="<?=htmlspecialchars($searchQ)?>" placeholder="Search sections, features, resources..." onchange="this.form.submit()"/>
    </div>

    <!-- Category filter -->
    <div class="filter-row">
      <span class="filter-label">Category:</span>
      <?php foreach($categories as $key=>[$label,$color,$bg]): ?>
      <button type="submit" name="cat" value="<?=$key?>"
        class="pill <?=$activeCat===$key?'active':''?>"
        style="<?=$activeCat===$key?"background:{$color};color:#fff":"?"?>">
        <?=$label?>
        <?php if($key!=='all'): $cnt=count(array_filter($sections,fn($s)=>$s['cat']===$key)); echo "($cnt)"; endif; ?>
      </button>
      <?php endforeach; ?>
    </div>

    <!-- Floor filter -->
    <div class="filter-row" style="margin-top:0">
      <span class="filter-label">Floor:</span>
      <button type="submit" name="floor" value="0" class="pill <?=$activeFloor===0?'active':''?>" style="<?=$activeFloor===0?'background:var(--primary);color:#fff':''?>">All Floors</button>
      <?php for($f=1;$f<=3;$f++): ?>
      <button type="submit" name="floor" value="<?=$f?>" class="pill <?=$activeFloor===$f?'active':''?>" style="<?=$activeFloor===$f?'background:var(--primary);color:#fff':''?>"><?=$floorNames[$f]?></button>
      <?php endfor; ?>
    </div>
  </form>

  <?php
  // Filter sections
  $filtered = array_filter($sections, function($s) use($activeCat,$activeFloor,$searchQ) {
    if($activeCat!=='all' && $s['cat']!==$activeCat) return false;
    if($activeFloor && $s['floor']!==$activeFloor) return false;
    if($searchQ) {
      $hay = strtolower($s['name'].' '.$s['desc'].' '.implode(' ',$s['features']));
      if(strpos($hay,$searchQ)===false) return false;
    }
    return true;
  });

  if(empty($filtered)): ?>
  <div class="no-results">
    <div class="no-results-icon">🔍</div>
    <h3 style="font-size:18px;color:var(--text)">No sections found</h3>
    <p style="color:var(--muted);margin-top:6px">Try adjusting your search or filters</p>
    <a href="?page=sections" class="btn-primary" style="margin-top:16px;display:inline-flex">Clear all filters</a>
  </div>
  <?php else:
    echo '<p style="font-size:13px;color:var(--muted);margin-bottom:4px">Showing '.count($filtered).' of '.count($sections).' sections</p>';
    $floors = $activeFloor ? [$activeFloor] : [1,2,3];
    foreach($floors as $f):
      $fSecs = array_filter($filtered,fn($s)=>$s['floor']===$f);
      if(empty($fSecs)) continue;
  ?>
  <div class="floor-divider">
    <div class="floor-divider-line"></div>
    <div class="floor-divider-label"><?=$floorNames[$f]?> · <?=count($fSecs)?> section<?=count($fSecs)!==1?'s':''?></div>
    <div class="floor-divider-line"></div>
  </div>
  <div class="sections-grid">
    <?php foreach($fSecs as $s): ?>
    <div class="section-card" onclick="openFullModal('<?=$s['id']?>')">
      <div class="sc-icon" style="background:<?=$s['light']?>"><?=$s['icon']?></div>
      <div style="flex:1;min-width:0">
        <div class="sc-name"><?=htmlspecialchars($s['name'])?></div>
        <div class="sc-meta">
          <span class="sc-badge" style="background:<?=$s['light']?>;color:<?=$s['color']?>">Floor <?=$s['floor']?></span>
          <?php if($s['dewey']): ?><span class="sc-dewey">Dewey <?=$s['dewey']?></span><?php endif; ?>
        </div>
        <div class="sc-desc"><?=htmlspecialchars($s['desc'])?></div>
        <div class="sc-features">
          <?php foreach(array_slice($s['features'],0,4) as $feat): ?>
          <span class="sc-feat"><?=htmlspecialchars($feat)?></span>
          <?php endforeach;
          if(count($s['features'])>4): ?>
          <span class="sc-feat">+<?=count($s['features'])-4?> more</span>
          <?php endif; ?>
        </div>
        <div class="sc-foot">
          <span>👥 Cap: <?=$s['cap']?></span>
          <span>🕐 <?=explode('|',$s['hours'])[0]?></span>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endforeach; endif; ?>
</div>

<script>
var sectionsData = <?=json_encode(array_values($sections))?>;
function openFullModal(id) {
  var s = sectionsData.find(function(x){ return x.id===id; });
  if(!s) return;
  document.getElementById('modalIcon').textContent = s.icon;
  document.getElementById('modalTitle').textContent = s.name;
  document.getElementById('modalFloor').innerHTML = '<span style="background:'+s.color+';color:#fff;font-size:11px;font-weight:700;padding:2px 10px;border-radius:20px">Floor '+s.floor+'</span>';
  document.getElementById('modalDesc').textContent = s.desc;
  document.getElementById('modalCap').textContent = s.cap;
  document.getElementById('modalHours').innerHTML = s.hours.split('|').map(function(h){ return '<p>'+h.trim()+'</p>'; }).join('');
  document.getElementById('modalFeatures').innerHTML = s.features.map(function(f){
    return '<div class="feat-item"><div class="feat-check" style="background:'+s.color+'20;color:'+s.color+'">✓</div>'+f+'</div>';
  }).join('');
  document.getElementById('modalDebt').innerHTML = s.dewey ? '<p style="font-size:12px;color:var(--muted);margin-top:4px">Dewey Range: '+s.dewey+'</p>' : '';
  document.getElementById('modalMapBtn').onclick = function(){ window.location.href='?page=map'; };
  document.getElementById('sectionModal').classList.add('open');
}
function closeModal() { document.getElementById('sectionModal').classList.remove('open'); }
</script>

<?php elseif ($page === 'events') :
  $filterType = isset($_GET['type']) && array_key_exists($_GET['type'],$typeConfig) ? $_GET['type'] : 'all';
  $filtered = $filterType==='all' ? $announcements : array_filter($announcements,fn($a)=>$a['type']===$filterType);
?>

<!-- ── EVENTS PAGE ── -->
<div class="container">
  <div class="page-header">
    <h1>📅 Events & News</h1>
    <p>Stay up to date with library announcements and upcoming programs</p>
  </div>

  <div class="events-layout">
    <!-- Announcements -->
    <div>
      <div class="filter-row">
        <span class="filter-label">Filter:</span>
        <a href="?page=events" class="pill <?=$filterType==='all'?'active':''?>" style="<?=$filterType==='all'?'background:var(--primary);color:#fff':''?>">All</a>
        <?php foreach($typeConfig as $type=>$cfg): ?>
        <a href="?page=events&type=<?=$type?>" class="pill <?=$filterType===$type?'active':''?>" style="<?=$filterType===$type?"background:{$cfg['color']};color:#fff":''?>"><?=$cfg['label']?></a>
        <?php endforeach; ?>
      </div>

      <?php if(empty($filtered)): ?>
      <div class="no-results"><div class="no-results-icon">🔔</div><p>No announcements in this category</p></div>
      <?php else: foreach($filtered as $item):
        $cfg = $typeConfig[$item['type']]; ?>
      <div class="event-card">
        <div class="event-type-icon" style="background:<?=$cfg['bg']?>"><?=$cfg['icon']?></div>
        <div style="flex:1">
          <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:8px;flex-wrap:wrap">
            <div class="event-card-title"><?=htmlspecialchars($item['title'])?></div>
            <span class="event-type-badge" style="background:<?=$cfg['bg']?>;color:<?=$cfg['color']?>"><?=$cfg['label']?></span>
          </div>
          <div class="event-card-date" style="color:<?=$cfg['color']?>"><?=htmlspecialchars($item['date'])?></div>
          <div class="event-card-desc"><?=htmlspecialchars($item['desc'])?></div>
        </div>
      </div>
      <?php endforeach; endif; ?>
    </div>

    <!-- Sidebar -->
    <div>
      <div class="programs-list">
        <div style="padding:12px 16px;border-bottom:1px solid var(--border);font-weight:700;font-size:14px;color:var(--text)">Recurring Programs</div>
        <?php foreach([
          ['Toddler Storytime','Every Tuesday, 10am','Children\'s Library'],
          ['Teen Book Club','Every 2nd Friday, 4pm','Study Rooms, Floor 2'],
          ['Digital Literacy Class','Wednesdays, 2pm','Computer Lab, Floor 2'],
          ['Senior Reading Circle','Every Thursday, 11am','Quiet Reading Room'],
          ['Maker Space Workshop','First Saturday, 1pm','Digital Media Lab, Floor 3'],
          ['Family Game Night','Last Friday, 6pm','Seminar Room, Floor 3'],
        ] as [$name,$sched,$loc]): ?>
        <div class="program-item">
          <div class="program-name"><?=$name?></div>
          <div class="program-sched"><?=$sched?></div>
          <div class="program-loc">📍 <?=$loc?></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="newsletter-box mt-4">
        <h3>🔔 Stay Updated</h3>
        <p>Sign up for our monthly newsletter with events, new arrivals, and library news.</p>
        <form onsubmit="alert('Thank you for subscribing!');return false;">
          <input type="email" placeholder="Your email address" required/>
          <button type="submit" class="btn-primary" style="width:100%;justify-content:center">Subscribe</button>
        </form>
      </div>

      <div class="closure-box">
        <h4>⚠️ Holiday Closures 2026</h4>
        <ul>
          <?php foreach(['June 19 — Juneteenth','July 4 — Independence Day','Sep 7 — Labor Day','Nov 26 — Thanksgiving','Dec 25 — Christmas','Jan 1, 2027 — New Year\'s'] as $d): ?>
          <li><?=$d?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php elseif ($page === 'contact') : ?>

<!-- ── CONTACT PAGE ── -->
<div class="container">
  <div class="page-header">
    <h1>📞 Contact Us</h1>
    <p>Get in touch — we're here to help</p>
  </div>

  <div class="contact-layout">
    <!-- Info column -->
    <div>
      <div class="info-card">
        <div class="info-card-head">Library Information</div>
        <div class="info-item">
          <div class="info-item-icon">📍</div>
          <div><div class="info-item-label">Address</div><div class="info-item-val">123 Library Avenue<br>City Center, State 10001</div></div>
        </div>
        <div class="info-item">
          <div class="info-item-icon">📞</div>
          <div><div class="info-item-label">Phone</div><div class="info-item-val">(555) 234-5678<br><small style="font-size:11px;color:var(--muted)">TDD/TTY: (555) 234-5699</small></div></div>
        </div>
        <div class="info-item">
          <div class="info-item-icon">📧</div>
          <div><div class="info-item-label">Email</div><div class="info-item-val">info@citylibrary.org</div></div>
        </div>
        <div class="info-item">
          <div class="info-item-icon">🕐</div>
          <div><div class="info-item-label">Hours</div><div class="info-item-val">Mon–Fri: 8am–8pm<br>Sat: 9am–6pm<br>Sun: 10am–4pm</div></div>
        </div>
      </div>

      <div class="map-placeholder">
        <span style="font-size:32px">📍</span>
        <div style="font-size:14px;font-weight:600;color:var(--text)">123 Library Avenue</div>
        <div style="font-size:12px;color:var(--muted)">City Center, State 10001</div>
        <a href="#" style="font-size:12px;color:var(--primary);font-weight:600;margin-top:4px">Open in Maps ↗</a>
      </div>

      <div class="dept-card">
        <div style="padding:11px 16px;border-bottom:1px solid var(--border);font-weight:700;font-size:13px;color:var(--text)">Department Contacts</div>
        <?php foreach([
          ['General Information','(555) 234-5678','info@citylibrary.org'],
          ["Children's Library",'(555) 234-5679','children@citylibrary.org'],
          ['Reference & Research','(555) 234-5680','reference@citylibrary.org'],
          ['Special Collections','(555) 234-5681','archives@citylibrary.org'],
          ['Digital Media Lab','(555) 234-5682','digitallab@citylibrary.org'],
          ['Event Bookings','(555) 234-5683','events@citylibrary.org'],
        ] as [$name,$phone,$email]): ?>
        <div class="dept-item">
          <div class="dept-name"><?=$name?></div>
          <div class="dept-phone"><?=$phone?></div>
          <div class="dept-email"><?=$email?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Form + FAQ column -->
    <div>
      <div class="form-card">
        <div class="form-head">
          <h2>Send Us a Message</h2>
          <p>We typically respond within 1–2 business days</p>
        </div>
        <div class="form-body">
          <?php if($form_sent): ?>
          <div class="form-success">
            <div class="success-icon">✅</div>
            <h3 style="font-size:18px;color:var(--text);margin-bottom:6px">Message Sent!</h3>
            <p style="color:var(--muted);font-size:14px">Thank you for contacting us. We'll get back to you soon.</p>
          </div>
          <?php else: ?>
          <form method="post" action="?page=contact">
            <input type="hidden" name="contact_form" value="1"/>
            <div class="form-grid">
              <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="name" placeholder="Your full name" required/>
              </div>
              <div class="form-group">
                <label>Email Address *</label>
                <input type="email" name="email" placeholder="your@email.com" required/>
              </div>
            </div>
            <div class="form-group">
              <label>Subject *</label>
              <select name="subject" required>
                <option value="">Select a subject...</option>
                <option>General Inquiry</option>
                <option>Library Card</option>
                <option>Book Request</option>
                <option>Event / Room Booking</option>
                <option>Special Collections</option>
                <option>Accessibility</option>
                <option>Feedback / Suggestion</option>
                <option>Other</option>
              </select>
            </div>
            <div class="form-group">
              <label>Message *</label>
              <textarea name="message" rows="5" placeholder="How can we help you?" required></textarea>
            </div>
            <button type="submit" class="btn-primary">✉️ Send Message</button>
          </form>
          <?php endif; ?>
        </div>
      </div>

      <!-- FAQ -->
      <div class="faq-wrap mt-6">
        <div class="faq-head">Frequently Asked Questions</div>
        <?php foreach([
          ['How do I get a library card?','Visit the Main Entrance desk with a valid photo ID and proof of address. Library cards are free for all city residents.'],
          ['Can I renew books online?','Yes! Log in at citylibrary.org or call us to renew loans up to 3 times, provided no one else has reserved the item.'],
          ['How do I reserve a study room?','Study rooms can be booked online, in person at the desk, or by phone. Available in 2-hour slots.'],
          ['Is WiFi available?','Free high-speed WiFi is available throughout the library. Connect to "CityLibrary_Public" — no password required.'],
          ['What is the interlibrary loan service?','We can borrow books and materials from other libraries in the network. Submit your request at the circulation desk or online.'],
          ['Are there printing services?','Yes — B&W and color printing at the Computer Lab on Floor 2. Costs: 10¢/page (B&W) and 50¢/page (color).'],
        ] as $i=>[$q,$a]): ?>
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(<?=$i?>)">
            <?=htmlspecialchars($q)?>
            <span class="faq-toggle" id="faq-toggle-<?=$i?>">+</span>
          </button>
          <div class="faq-a" id="faq-a-<?=$i?>"><?=htmlspecialchars($a)?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<script>
function toggleFaq(i) {
  var a = document.getElementById('faq-a-'+i);
  var t = document.getElementById('faq-toggle-'+i);
  var isOpen = a.classList.toggle('open');
  t.textContent = isOpen ? '−' : '+';
}
</script>

<?php endif; ?>
</main>

<!-- ══════════════════════════════════════════
     UNIVERSAL SECTION DETAIL MODAL
     ══════════════════════════════════════════ -->
<div class="modal-overlay" id="sectionModal" onclick="if(event.target===this)closeModal()">
  <div class="modal">
    <div class="modal-header" id="modalHeaderWrap">
      <button class="modal-close" onclick="closeModal()">✕</button>
      <div style="display:flex;align-items:center;gap:12px;margin-top:4px">
        <div style="font-size:32px" id="modalIcon">📚</div>
        <div>
          <div class="modal-title" id="modalTitle">Section Name</div>
          <div id="modalFloor" style="margin-top:3px"></div>
          <div id="modalDebt"></div>
        </div>
      </div>
    </div>
    <div class="modal-body">
      <p id="modalDesc" style="font-size:13px;color:var(--muted);line-height:1.6;margin-bottom:12px"></p>
      <div class="modal-stat-grid">
        <div class="modal-stat">
          <div class="modal-stat-label">👥 Capacity</div>
          <div class="modal-stat-value" id="modalCap">—</div>
          <div class="modal-stat-sub">people max</div>
        </div>
        <div class="modal-stat">
          <div class="modal-stat-label">📍 Location</div>
          <div class="modal-stat-value" style="font-size:14px" id="modalLocFloor">—</div>
          <div class="modal-stat-sub">Floor level</div>
        </div>
      </div>
      <div class="hours-box">
        <div class="hours-box-title">🕐 Opening Hours</div>
        <div id="modalHours"></div>
      </div>
      <div>
        <div style="font-size:13px;font-weight:700;color:var(--text);margin-bottom:8px">📋 Available Here</div>
        <div class="features-list" id="modalFeatures"></div>
      </div>
    </div>
    <div class="modal-footer">
      <button id="modalMapBtn" class="btn-primary" style="flex:1;justify-content:center">🗺️ View on Map</button>
      <button onclick="closeModal()" class="btn-secondary" style="flex:1;justify-content:center">Close</button>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <div class="footer-inner">
    <div class="footer-grid">
      <div class="footer-brand">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px">
          <div class="logo-icon">📖</div>
          <div><div class="logo-title">City Public Library</div><div class="logo-sub">Est. 1892</div></div>
        </div>
        <p>Connecting our community through books, learning, and shared spaces since 1892.</p>
        <div class="social-icons">
          <button class="social-btn" title="Facebook">f</button>
          <button class="social-btn" title="Twitter">t</button>
          <button class="social-btn" title="Instagram">ig</button>
          <button class="social-btn" title="YouTube">▶</button>
        </div>
      </div>
      <div class="footer-col">
        <h3>Navigate</h3>
        <ul>
          <?php foreach($nav as $pg=>[$icon,$label]): ?>
          <li><a href="?page=<?=$pg?>"><?=$label?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="footer-col">
        <h3>Services</h3>
        <ul>
          <?php foreach(['Library Card','Book Catalog','E-Books & Audio','Study Room Booking','Interlibrary Loans','Research Assistance'] as $s): ?>
          <li><a href="?page=contact"><?=$s?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="footer-col footer-hours">
        <h3>Hours & Contact</h3>
        <p><strong>Mon–Fri</strong> 8:00am – 8:00pm</p>
        <p><strong>Saturday</strong> 9:00am – 6:00pm</p>
        <p><strong>Sunday</strong> 10:00am – 4:00pm</p>
        <p style="margin-top:10px">📞 (555) 234-5678</p>
        <p>📧 info@citylibrary.org</p>
        <p>📍 123 Library Ave</p>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© <?=date('Y')?> City Public Library. All rights reserved.</p>
      <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Accessibility</a>
        <a href="#">Site Map</a>
      </div>
    </div>
  </div>
</footer>

<!-- GLOBAL JS -->
<script>
function toggleMenu() {
  document.getElementById('mobileMenu').classList.toggle('open');
}

// Close modal on Escape
document.addEventListener('keydown', function(e) {
  if(e.key==='Escape') closeModal();
});

// Make sure closeModal is globally available even if not defined on current page
if(typeof closeModal === 'undefined') {
  function closeModal() {
    document.getElementById('sectionModal').classList.remove('open');
  }
}
if(typeof openFullModal === 'undefined') {
  function openFullModal(id) {
    // Fallback: try to find in sectionsData if it exists
    if(typeof sectionsData !== 'undefined') {
      var s = sectionsData.find(function(x){ return x.id===id; });
      if(!s) return;
      document.getElementById('modalIcon').textContent = s.icon;
      document.getElementById('modalTitle').textContent = s.name;
      document.getElementById('modalFloor').innerHTML = '<span style="background:'+s.color+';color:#fff;font-size:11px;font-weight:700;padding:2px 10px;border-radius:20px">Floor '+s.floor+'</span>';
      document.getElementById('modalDesc').textContent = s.desc;
      document.getElementById('modalCap').textContent = s.cap;
      document.getElementById('modalHours').innerHTML = s.hours.split('|').map(function(h){ return '<p>'+h.trim()+'</p>'; }).join('');
      document.getElementById('modalFeatures').innerHTML = s.features.map(function(f){
        return '<div class="feat-item"><div class="feat-check" style="background:'+s.color+'20;color:'+s.color+'">✓</div>'+f+'</div>';
      }).join('');
      document.getElementById('modalDebt').innerHTML = s.dewey ? '<p style="font-size:12px;color:var(--muted);margin-top:4px">Dewey Range: '+s.dewey+'</p>' : '';
      document.getElementById('modalMapBtn').onclick = function(){ window.location.href='?page=map'; };
      document.getElementById('sectionModal').classList.add('open');
    }
  }
}
</script>
</body>
</html>
