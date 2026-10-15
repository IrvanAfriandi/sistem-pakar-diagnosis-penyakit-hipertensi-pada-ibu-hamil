import fs from 'node:fs/promises';
import path from 'node:path';
import { chromium } from 'playwright';
import sharp from 'sharp';

const root = process.cwd();
const baseUrl = process.env.SCREENSHOT_BASE_URL || 'http://127.0.0.1:8017';
const outputDir = path.join(root, 'screenshots');
const stateDir = path.join('C:/Temp', 'sistem-diagnosis-screenshot');
const results = [];

await fs.mkdir(outputDir, { recursive: true });
for (const entry of await fs.readdir(outputDir)) await fs.rm(path.join(outputDir, entry), { recursive: true, force: true });
await fs.mkdir(stateDir, { recursive: true });

const browser = await chromium.launch({ headless: true });
const contextOptions = { viewport: { width: 1920, height: 870 }, deviceScaleFactor: 1 };

async function settle(page) {
  await page.waitForLoadState('networkidle', { timeout: 15000 }).catch(() => {});
  await page.evaluate(() => document.fonts?.ready).catch(() => {});
  await page.addStyleTag({ content: '.debugbar,.cookie-banner,[id*=cookie],[class*=cookie]{display:none!important}' }).catch(() => {});
  await page.waitForTimeout(1200);
}

async function capture(page, file, caption, role) {
  await settle(page);
  const png = path.join(outputDir, `${file}.png`);
  const webp = path.join(outputDir, `${file}.webp`);
  await page.screenshot({ path: png, fullPage: false });
  await sharp(png).webp({ quality: 85 }).toFile(webp);
  await fs.rm(png);
  const meta = await sharp(webp).metadata();
  if (meta.width !== 1920 || meta.height !== 870) throw new Error(`${file} has invalid size ${meta.width}x${meta.height}`);
  results.push({ file: `${file}.webp`, caption, role });
}

async function login(role, email, password) {
  const state = path.join(stateDir, `${role}.json`);
  const context = await browser.newContext(contextOptions);
  const page = await context.newPage();
  await page.goto(`${baseUrl}/login`);
  await page.locator('input[name=email]').fill(email);
  await page.locator('input[name=password]').fill(password);
  await page.locator('button[type=submit]').click();
  await page.waitForURL('**/admin_dashboard', { timeout: 15000 });
  await context.storageState({ path: state });
  return { context, page };
}

const admin = await login('admin', 'admin.screenshot@example.test', 'demo1234');
await capture(admin.page, '01-dashboard-admin', 'Dashboard ringkas sistem pakar dan statistik data utama.', 'admin');

await admin.page.goto(`${baseUrl}/data-pasien`);
await admin.page.locator('#searchPatient').fill('Alya');
await capture(admin.page, '02-data-pasien-admin', 'Daftar pasien dummy dengan pencarian nama aktif.', 'admin');

await admin.page.locator('[data-bs-target="#addPatientModal"]').click();
await admin.page.locator('#addPatientModal input[name=nama_pasien]').fill('Maya Contoh');
await admin.page.locator('#addPatientModal input[name=usia]').fill('28');
await admin.page.locator('#addPatientModal input[name=email]').fill('maya.demo@example.test');
await admin.page.locator('#addPatientModal textarea[name=alamat]').fill('Jl. Contoh Fiktif No. 1');
await capture(admin.page, '03-form-pasien-admin', 'Form tambah pasien terisi data contoh di dalam modal.', 'admin');

await admin.page.goto(`${baseUrl}/admin`);
await admin.page.locator('[data-bs-target="#addAdminModal"]').click();
await admin.page.locator('#addAdminModal input[name=name]').fill('Operator Contoh');
await admin.page.locator('#addAdminModal input[name=email]').fill('operator.demo@example.test');
await admin.page.locator('#addAdminModal input[name=password]').fill('demo1234');
await admin.page.locator('#addAdminModal select[name=role]').selectOption('petugas');
await capture(admin.page, '04-manajemen-pengguna-admin', 'Manajemen pengguna dan penetapan role melalui form admin.', 'admin');

await admin.page.goto(`${baseUrl}/penyakit`);
await admin.page.locator('[data-bs-target="#addPenyakitModal"]').click();
await admin.page.locator('#addPenyakitModal input[name=kode_penyakit]').fill('P09');
await admin.page.locator('#addPenyakitModal input[name=nama_penyakit]').fill('Kondisi Contoh');
await admin.page.locator('#addPenyakitModal textarea[name=penjelasan]').fill('Penjelasan kondisi kesehatan contoh untuk demo.');
await admin.page.locator('#addPenyakitModal textarea[name=penanganan]').fill('Konsultasikan dengan tenaga kesehatan.');
await capture(admin.page, '05-data-penyakit-admin', 'Daftar penyakit dan form tambah data yang terisi.', 'admin');

await admin.page.goto(`${baseUrl}/gejala`);
await admin.page.locator('.search-box').fill('sakit');
await capture(admin.page, '06-data-gejala-admin', 'Daftar gejala dengan pencarian aktif.', 'admin');

await admin.page.goto(`${baseUrl}/basis-pengetahuan`);
await admin.page.locator('#filterPenyakit').selectOption({ index: 1 });
await admin.page.locator('[data-bs-target="#addKnowledgeModal"]').click();
await admin.page.locator('#addKnowledgeModal select[name=id_penyakit]').selectOption({ index: 1 });
await admin.page.locator('#addKnowledgeModal select[name=id_gejala]').selectOption({ index: 1 });
await admin.page.locator('#addKnowledgeModal input[name=cf_pakar]').fill('0.85');
await capture(admin.page, '07-basis-pengetahuan-admin', 'Basis pengetahuan certainty factor dengan filter dan form aturan.', 'admin');

await admin.page.goto(`${baseUrl}/riwayat-konsultasi`);
await admin.page.locator('[data-bs-target="#detailModal"]').first().click();
await capture(admin.page, '08-riwayat-konsultasi-admin', 'Riwayat konsultasi dummy dengan detail hasil terbuka.', 'admin');
await admin.context.close();

const petugas = await login('petugas', 'petugas.screenshot@example.test', 'demo1234');
await capture(petugas.page, '09-dashboard-petugas', 'Dashboard yang terlihat untuk role petugas.', 'petugas');
await petugas.context.close();

const publicContext = await browser.newContext(contextOptions);
const publicPage = await publicContext.newPage();
await publicPage.goto(`${baseUrl}/login`);
await capture(publicPage, '10-login', 'Halaman login dengan form autentikasi role pengguna.', 'publik');
await publicPage.goto(`${baseUrl}/diagnosis?id_konsultasi=1`);
const sliders = publicPage.locator('.symptom-slider');
for (const [index, value] of [0.8, 0.65, 0.55].entries()) {
  await sliders.nth(index).evaluate((el, v) => { el.value = String(v); el.dispatchEvent(new Event('input', { bubbles: true })); }, value);
}
await capture(publicPage, '11-form-diagnosis-publik', 'Form diagnosis dengan beberapa gejala dan nilai keyakinan terisi.', 'publik');
await publicPage.locator('#diagnoseBtn').click();
await publicPage.waitForURL('**/diagnosis/*', { timeout: 15000 });
await capture(publicPage, '12-hasil-diagnosis-publik', 'Hasil diagnosis contoh dengan informasi pasien dan tingkat keyakinan.', 'publik');
await publicContext.close();

await browser.close();
console.log(JSON.stringify(results, null, 2));
