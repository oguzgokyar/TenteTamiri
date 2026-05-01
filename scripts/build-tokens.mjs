import { mkdir, readFile, writeFile } from "node:fs/promises";
import path from "node:path";
import { fileURLToPath } from "node:url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const rootDir = path.resolve(__dirname, "..");
const sourcePath = path.join(rootDir, "shared", "design-tokens.json");
const targets = [
  path.join(rootDir, "preview", "src", "styles", "tokens.css"),
  path.join(rootDir, "wordpress", "wp-content", "themes", "antigravity-elementor", "assets", "css", "tokens.css")
];

const flattenTokens = (value, trail = []) => {
  if (value === null || value === undefined) {
    return [];
  }

  if (typeof value !== "object" || Array.isArray(value)) {
    return [[trail.join("-"), value]];
  }

  return Object.entries(value).flatMap(([key, nestedValue]) => flattenTokens(nestedValue, [...trail, key]));
};

const renderCss = (tokens) => {
  const declarations = flattenTokens(tokens)
    .map(([key, value]) => `  --ag-${key}: ${value};`)
    .join("\n");

  return `:root {\n${declarations}\n}\n`;
};

const main = async () => {
  const tokenPayload = await readFile(sourcePath, "utf8");
  const tokens = JSON.parse(tokenPayload);
  const cssOutput = renderCss(tokens);

  await Promise.all(
    targets.map(async (targetPath) => {
      await mkdir(path.dirname(targetPath), { recursive: true });
      await writeFile(targetPath, `/* Auto-generated from shared/design-tokens.json */\n${cssOutput}`, "utf8");
    })
  );

  process.stdout.write(`Generated ${targets.length} token stylesheets.\n`);
};

main().catch((error) => {
  process.stderr.write(`${error.stack}\n`);
  process.exitCode = 1;
});
