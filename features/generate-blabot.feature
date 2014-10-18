Feature: Generate Blabols
  As Visitor,
  I would like to get some Blabols,
  in order to copy them to clipboard.

Scenario: No Dictionary
  Given No Dictionary
  When Requested to Generate Blabols
  Then Gets empty Blabols

Scenario: Empty Dictionary
  Given Empty Dictionary
  When Requested to Generate Blabols
  Then Gets empty Blabols