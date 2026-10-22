# Design System Specification

คู่มือมาตรฐานการออกแบบ Modern UI สำหรับ jirathx-app

---

## 1. Core Principles

1. **Dark & Gray 80% / Blue 20%**
   - 80% ของพื้นที่เป็น Dark & Gray: พื้นหลัง โครงสร้าง การ์ด ข้อความทั่วไป
   - 20% ของพื้นที่เป็น Blue Accent: จุดโฟกัส ปุ่มสำคัญ สถานะที่กำลังใช้งาน ลิงก์ที่ถูกเลือก
2. **No Border**
   - ห้ามใส่เส้นขอบรอบ Card, Container, Table, Input หรือ Modal
   - แยกพื้นที่ด้วยความต่างของระดับสีพื้นผิวและการเว้นระยะ
3. **No Shadow**
   - ห้ามใช้ Drop Shadow ทุกประเภท เช่น `shadow-sm`, `shadow-md`, `shadow-lg`
   - พื้นผิวเป็นแบบ Flat เรียบหรู
4. **No BG Icon**
   - ห้ามใส่พื้นหลังสี่เหลี่ยมหรือวงกลมรอบไอคอน เช่น ห้ามใช้ `bg-blue-500/10 rounded-full p-2`
   - แสดงไอคอนแบบลอยอิสระ กำหนดเฉพาะขนาดและสีของเส้นไอคอนโดยตรง
5. **Single-Language Rule**
   - ห้ามเขียนภาษาคู่ในวงเล็บเด็ดขาด เช่น ห้ามเขียน `ระบบ (System)`, `แดชบอร์ด (Dashboard)`, `สถานะ (Status)`
   - เลือกใช้ภาษาเดียวตามบริบท เช่น ภาษาไทยล้วน หรือภาษาอังกฤษล้วน

---

## 2. Color Palette & Distribution

### 80% Neutral Base (Dark / Gray)
- **Base Background:** `#09090b` (`bg-zinc-950`)
- **Surface Level 1:** `#18181b` (`bg-zinc-900`)
- **Surface Level 2 (Hover / Active):** `#27272a` (`bg-zinc-800`)
- **Text Primary:** `#f4f4f5` (`text-zinc-100`)
- **Text Secondary / Muted:** `#a1a1aa` (`text-zinc-400`)
- **Text Subtle:** `#71717a` (`text-zinc-500`)

### 20% Accent (Blue)
- **Primary Blue:** `#2563eb` (`bg-blue-600` / `text-blue-600`)
- **Blue Hover:** `#1d4ed8` (`bg-blue-700`)
- **Blue Active / Highlight:** `#3b82f6` (`text-blue-500` / `bg-blue-500`)
- **Blue Soft Text:** `#60a5fa` (`text-blue-400`)

---

## 3. Visual Hierarchy

เมื่อไม่มี Border และ Shadow ให้สร้างลำดับสายตาด้วย 4 องค์ประกอบนี้:

1. **ระดับสีพื้นผิว**
   - Canvas ล่างสุด: `bg-zinc-950`
   - Card และ Container: `bg-zinc-900`
   - แถบที่กำลังเลือกหรือ Hover: `bg-zinc-800`
2. **ขนาดและความหนาของตัวอักษร**
   - Page Title: `text-2xl font-bold text-zinc-100`
   - Section Title: `text-lg font-semibold text-zinc-200`
   - Body Text: `text-sm text-zinc-300`
   - Metadata / Helper: `text-xs text-zinc-500`
3. **สีเน้นเฉพาะจุดสำคัญ**
   - ปุ่มหลัก (Primary Action): พื้นหลังสี Blue
   - จุดบอกสถานะ Active: ข้อความหรือ Indicator สี Blue
   - ข้อมูลทั่วไป: สีขาวหรือเทา ไม่ดึงสายตาแข่งกับจุดเน้น
4. **ระยะห่างและจังหวะช่องไฟ**
   - เว้นระยะระหว่างกลุ่มข้อมูลด้วย `gap-6` หรือ `space-y-6`
   - Padding ภายในการ์ดใช้ `p-5` หรือ `p-6`

---

## 4. Component Rules

### Card & Panels
- ใช้ `bg-zinc-900 rounded-xl p-5`
- ห้ามใช้ `border` หรือ `shadow`
- เมื่อต้องการให้คลิกได้ ให้ใช้ Hover เป็น `hover:bg-zinc-800/80 transition-colors`

### Buttons
- **Primary Button:** `bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-lg px-4 py-2` (ห้ามมี Border/Shadow)
- **Secondary Button:** `bg-zinc-800 hover:bg-zinc-700 text-zinc-200 rounded-lg px-4 py-2`
- **Ghost Button:** `text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50 rounded-lg px-3 py-1.5`

### Form Controls
- Input: `bg-zinc-900 focus:bg-zinc-850 text-zinc-100 placeholder:text-zinc-500 rounded-lg px-3.5 py-2.5 focus:outline-none focus:ring-1 focus:ring-blue-500`
- ห้ามใส่ Default Border รอบ Input

### Icons
- ใช้ไอคอนจาก Lucide
- กำหนดขนาดด้วย `size-4` หรือ `size-5`
- สีของไอคอนใช้ `text-zinc-400` หรือ `text-blue-500`
- ห้ามครอบด้วย Box หรือ Circle ที่มีสีพื้นหลัง

### Tables & Lists
- พื้นหลังหัวตาราง: `bg-zinc-900 text-zinc-400 text-xs uppercase tracking-wider`
- แถวข้อมูล: `hover:bg-zinc-800/40 transition-colors`
- ห้ามมีเส้นตารางแนวตั้งหรือแนวนอนหนา ใช้เพียงการเว้นระยะและสีพื้นหลังเพื่อแยกแถว

---

## 5. Copywriting Guidelines

- ใช้ภาษาไทยแบบกระชับ ชัดเจน หรือใช้ภาษาอังกฤษสากล
- ห้ามเขียนภาษาไทยตามด้วยภาษาอังกฤษในวงเล็บ
- ตัวอย่างคำศัพท์ที่ถูกต้อง:
  - แดชบอร์ด (ไม่ใช่ แดชบอร์ด (Dashboard))
  - การแจ้งซ่อม (ไม่ใช่ การแจ้งซ่อม (Repair Ticket))
  - บันทึกข้อมูล (ไม่ใช่ บันทึก (Save))
  - ลูกค้า (ไม่ใช่ ลูกค้า (Customer))
