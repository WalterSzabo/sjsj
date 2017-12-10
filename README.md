# SJSJ - Simple JavaScript Joiner

---

Join your JS-Files into one File.
Your Directory-Structure look like this:
(Save sjsj.exe wherever you want.)

**project**
- main.js (file)
- includes (dir)
  - _file_1.js (file)
  - _file_2.js (file)


**main.js**


// Comments or JS-Code

include 'includes/_functions.js';
include 'includes/_global.js';

// Comments or JS-Code
// ...


**Create a Batchfile:**
@ECHO OFF
SET SJSJ_BIN=C:\SJSJ\0.1
SET PATH=%SJSJ_BIN%;%PATH%
sjsj.exe H:\project\src\main.js H:\project\main.js
