# AI Conversation Archive

Date: 8 March 2026
Topic: Full Political Campaign Platform Development

Tags: #ai-chat #development #project-notes

## User

You are working inside a development workspace.

CRITICAL RULE:
All chat interactions must be saved inside the project as a permanent chat history.

For every interaction:

1. Record BOTH:
   * User message
   * Assistant response

2. Append the conversation to a Markdown file located at:

docs/chat-history.md

3. Use the following format:

## Chat Entry

Timestamp: (current date and time)

### User

(user message)

### Assistant

(assistant response)

---

4. Never overwrite previous chat entries.
   Always append new entries.

5. If the file does not exist, create it.

6. If the folder does not exist, create:

docs/

7. Treat the chat history as project documentation.

Goal:
Maintain a full, chronological archive of the development conversation inside the repository.

## Assistant

Understood. All content you provide will be converted into appropriate project files and saved in the workspace, with clear file paths and organized folder structure. Updates will be made to existing files when needed, and Markdown will be used for documentation.

Please provide your next text, idea, plan, documentation, or note, and I will save it accordingly.

---

## User

You are helping configure GitHub Copilot for this repository.

Create a workspace instruction file that ensures Copilot always understands and analyzes the entire codebase before generating responses.

Task:
Generate a repository-level Copilot instruction file located at:

.github/copilot-instructions.md

Requirements:

1. The instructions must force Copilot to always inspect the workspace and project structure before writing code.
2. Copilot should prefer reusing existing code instead of generating new implementations.
3. Copilot should reference file paths when explaining solutions.
4. Copilot must follow the coding style already present in the repository.
5. Copilot should check configuration files, database schemas, APIs, and modules before suggesting changes.
6. Copilot should only generate new files when necessary.
7. Copilot should show minimal diffs instead of rewriting entire files.
8. Copilot should prioritize maintainability and integration with the existing architecture.

The instructions should include sections for:

* Codebase awareness
* Workspace scanning
* Code reuse rules
* Modification rules
* File reference rules
* Safety rules

Output format:

1. Show the file path first
2. Then output the full Markdown file contents

Example format:

File: .github/copilot-instructions.md

```markdown
(full instructions here)
```

Ensure the instructions are clear, structured, and optimized for large multi-folder projects.

## Assistant

File: .github/copilot-instructions.md

```markdown
# Copilot Workspace Instructions

## Codebase Awareness
- Always analyze the entire workspace and project structure before generating any code or suggestions.
- Understand all folders, files, entry points, configuration files, database schemas, and APIs present in the repository.

## Workspace Scanning
- Before responding, scan the workspace to identify:
  - Folder structure
  - Main entry points
  - Frameworks and technologies used
  - Database connections and schemas
  - Configuration files
  - API routes and endpoints
  - Important classes, modules, and reusable code

## Code Reuse Rules
- Prefer reusing existing code, functions, and modules over creating new implementations.
- Integrate new features with current architecture and code patterns.
- Reference and leverage code from relevant files whenever possible.

## Modification Rules
- When making changes, show minimal diffs and avoid rewriting entire files.
- Only generate new files if no suitable location exists in the current codebase.
- Follow the coding style, formatting, and conventions already present in the repository.
- Prioritize maintainability and seamless integration with existing code.

## File Reference Rules
- Always reference file paths when explaining solutions, changes, or code locations.
- Use workspace-relative paths for clarity and traceability.

## Safety Rules
- Check configuration files, database schemas, APIs, and modules before suggesting or applying changes.
- Ensure all modifications are compatible with the current system architecture.
- Avoid breaking changes and maintain backward compatibility where possible.
- Validate input and output for security and correctness.

---
These instructions are designed to optimize Copilot's performance for large, multi-folder projects, ensuring maintainable, integrated, and context-aware code generation.
```

---