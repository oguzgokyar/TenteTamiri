import { mkdir, readFile, writeFile } from "node:fs/promises";
import path from "node:path";
import { fileURLToPath } from "node:url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const rootDir = path.resolve(__dirname, "..");
const sourcePath = path.join(rootDir, "shared", "business-profile.json");
const jsTarget = path.join(rootDir, "preview", "src", "data", "generated-business-profile.js");
const phpTarget = path.join(rootDir, "wordpress", "wp-content", "themes", "antigravity-elementor", "inc", "generated-business-profile.php");

const phpExport = (value, indent = 0) => {
  const spacing = "  ".repeat(indent);

  if (Array.isArray(value)) {
    if (value.length === 0) {
      return "[]";
    }

    const items = value
      .map((item) => `${"  ".repeat(indent + 1)}${phpExport(item, indent + 1)}`)
      .join(",\n");

    return `[\n${items}\n${spacing}]`;
  }

  if (value && typeof value === "object") {
    const entries = Object.entries(value);
    if (entries.length === 0) {
      return "[]";
    }

    const items = entries
      .map(([key, itemValue]) => `${"  ".repeat(indent + 1)}'${key}' => ${phpExport(itemValue, indent + 1)}`)
      .join(",\n");

    return `[\n${items}\n${spacing}]`;
  }

  if (typeof value === "string") {
    return `'${value.replaceAll("\\", "\\\\").replaceAll("'", "\\'")}'`;
  }

  if (typeof value === "number" || typeof value === "boolean") {
    return String(value);
  }

  if (value === null) {
    return "null";
  }

  throw new Error(`Unsupported value type: ${typeof value}`);
};

const main = async () => {
  const payload = await readFile(sourcePath, "utf8");
  const data = JSON.parse(payload);

  const jsOutput = `export const businessProfile = ${JSON.stringify(data, null, 2)};\n`;
  const phpOutput = `<?php\n/**\n * Auto-generated from shared/business-profile.json.\n */\n\nreturn ${phpExport(data)};\n`;

  await Promise.all([
    mkdir(path.dirname(jsTarget), { recursive: true }),
    mkdir(path.dirname(phpTarget), { recursive: true })
  ]);

  await Promise.all([
    writeFile(jsTarget, jsOutput, "utf8"),
    writeFile(phpTarget, phpOutput, "utf8")
  ]);

  process.stdout.write("Generated business profile artifacts.\n");
};

main().catch((error) => {
  process.stderr.write(`${error.stack}\n`);
  process.exitCode = 1;
});
