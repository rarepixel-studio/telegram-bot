# Telegram Bot API Update Guide

This guide explains how to implement new Telegram Bot API updates in this SDK. It keeps changes consistent with the project's architecture, validation rules, and testing requirements.

## Inputs You Must Use

- Official Telegram Bot API docs in `doc/telegram-bot-api.md`.
- Type grouping reference in `doc/telegram-bot-api-type-groups.md`.
- Method list in `doc/telegram-available-methods.md` (for diffing new releases).
- Existing patterns in `src/Requests`, `src/Objects`, `src/Enums`, and `src/Traits/ApiMethodWrappers.php`.

## Architecture Constraints (Must Preserve)

- **Api facade + wrappers**: Keep public method signatures on `Api` stable. Wrappers live in `src/Traits/ApiMethodWrappers.php`.
- **Request objects**: New/updated methods use request objects in `src/Requests`.
  - Required params in the constructor, optional params via fluent setters.
  - `toArray()` and `toWebhookPayload()` for serialization.
  - `validate()` must enforce Telegram constraints and throw `TelegramValidationException`.
- **Shared validation helpers**: Request objects must extend `TelegramApiRequest` and reuse:
  - `validateReplyParameters(array &$params): void`
  - `validateReplyMarkup(array &$params): void`
  - `normalizeReplyMarkupArray(array $replyMarkup): InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null`
  - If using individual properties instead of a `$params` array, add private helpers and still call the base normalization methods.
- **Objects**: New API objects live in `src/Objects` and extend `BaseObject` (Collection-based).
  - Add explicit getters for known fields.
  - Keep `__call()` as a fallback for unknown fields.
  - Maintain `relations()` mappings so nested objects hydrate correctly.
- **Enums**: Use `src/Enums` for finite-value parameters. Accept enums and strings only when needed for backward compatibility.
- **Interfaces**: Keep contracts in `src/Contracts` in sync with public API signatures.
- **Exceptions**: Use the existing exception hierarchy under `src/Exceptions` for new error conditions.

## What To Add When Telegram Releases Updates

Add the following where applicable:

- Request objects in `src/Requests` for new methods or changed parameter sets.
- Wrapper methods in `src/Traits/ApiMethodWrappers.php` that accept `array|RequestObject` and normalize to request objects.
- New object classes in `src/Objects` for new API types or composite payloads.
- New enums in `src/Enums` for fixed value sets.
- Updated `relations()` mappings for nested objects.
- Documentation updates in `doc/telegram-bot-api.md`, `doc/telegram-available-methods.md`, and `doc/telegram-bot-api-type-groups.md`.
- Tests under `tests/Unit` and `tests/Integration` for new behavior.

## Implementation Steps

- If you are updating a Telegram type (Object) or method, check that method or object's property and methods with the official docs. fix any previous mistakes (Missing fields, or fields not available in official doc, missing methods ect)

1. **Update the local spec**: Align `doc/telegram-bot-api.md` with the official update notes.
2. **Update method list**: Add any new methods to `doc/telegram-available-methods.md`.
3. **Add request object(s)**:
   - Required params in the constructor.
   - Optional params via fluent setters.
   - `validate()` enforces constraints and exclusivity rules.
   - Use the base helper methods for reply parameters and reply markup.
4. **Add Api wrapper**:
   - Add a wrapper in `src/Traits/ApiMethodWrappers.php`.
   - Keep the public signature unchanged.
   - Normalize arrays into request objects before dispatch.
5. **Implement the Api wrapper behavior**:
   - Call `post()` with the method name and payload.
   - Use `prepareResponse()` to hydrate objects when needed.
   - Ensure async and sync paths match existing patterns.
6. **Add/Update objects and relations**:
   - Add any new object classes in `src/Objects`.
   - Update `relations()` for nested types.
   - Add explicit getters and keep `__call()` fallback.
7. **Add enums**: Create or update enums in `src/Enums` for finite values.
8. **Update type groups**: Adjust `doc/telegram-bot-api-type-groups.md` when new types appear.
9. **Tests**:
   - Request validation and serialization.
   - Sync/async method execution.
   - Object hydration and relations.
   - Enum usage and invalid values.
10. **Formatting**: Run `vendor/bin/pint --dirty` before finalizing.

## Completion Checklist

- [ ] `doc/telegram-bot-api.md` matches the official update.
- [ ] New methods are listed in `doc/telegram-available-methods.md`.
- [ ] Request objects and Api wrappers are implemented.
- [ ] Api wrappers, objects, relations, and enums are updated.
- [ ] PHPDoc includes required `@param`, `@return`, and `@throws`.
- [ ] Tests exist and pass for new behavior.
- [ ] `vendor/bin/pint --dirty` has been run.
- [ ] `doc/telegram-bot-api-type-groups.md` reflects any new types.
