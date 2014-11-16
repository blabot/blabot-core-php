@generator
Feature: Generate blabols
  As visitor,
  I would like to get some blabols,
  in order to copy them to clipboard.

Scenario: No Dictionary
  Given no Dictionary
  When requested to generate blabols
  Then gets empty blabols

Scenario: Empty Dictionary
  Given empty dictionary
  When requested to generate blabols
  Then gets empty blabols

Scenario: Simple dictionary
  Given mock dictionary
  When requested to generate blabols
  Then gets simple blabols